import {
    NgZone, Component, OnInit, OnChanges, OnDestroy,
    Input, Output, EventEmitter, SimpleChanges, SimpleChange
} from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ISubscription } from "rxjs/Subscription";
import { Subject } from 'rxjs/Subject';
import 'rxjs/add/operator/debounceTime';

import { Config, Query, QueryParameters, ItemTypes } from 'geoplatform.client';

import { CkanService } from '../../shared/ckan.service';
import { Constraints, Constraint } from '../../models/constraint';

import { findOrgName } from './orgs';


@Component({
  selector: 'results-ckan',
  templateUrl: './ckan.component.html',
  styleUrls: ['./ckan.component.css']
})
export class CkanComponent implements OnInit {

    @Input() constraints: Constraints;

    private service : CkanService;
    private listener : ISubscription;
    public totalResults : number = 0;
    public pageSize : number = 10;
    public query : Query;
    public results : any;
    public loading: boolean = false;
    public error: Error = null;

    private queryChange: Subject<Query> = new Subject<Query>();

    constructor(
        private _ngZone: NgZone,
        private http : HttpClient
    ) {
        this.service = new CkanService(http);
        this.query = new Query()
            .pageSize(this.pageSize)
            .sort("metadata_modified desc");

        //use a subject so we can debounce query execution events
        this.queryChange
            .debounceTime(500)
            .subscribe((query) => this.executeQuery() );
    }

    ngOnInit() { }

    ngOnChanges( changes : SimpleChanges) {
        if(changes.constraints) {
            let constraints = changes.constraints.currentValue;
            this.onConstraintChange(constraints);

            if(this.listener)
                this.listener.unsubscribe();

            this.listener = constraints.on((constraint:Constraint) => {
                // console.log("CcbComponent.ngOnChanges() - Constraints changed: " +
                //     this.constraints.toString());
                this.onConstraintChange();
            });
        }
    }

    ngOnDestroy() {
        this.listener.unsubscribe();
    }

    onConstraintChange(constraints?: Constraints) {
        this.query = new Query().pageSize(this.pageSize);

        //apply constraints to tracked query object
        if(!constraints) constraints = this.constraints;
        this.constraints.apply(this.query);

        //need to handle converting GP Organization's to CKAN orgs.
        // This needs to happen before constraints.apply as the name of the GP Org
        // will most likely be needed to derive the CKAN org name.
        let publisher = constraints.get(QueryParameters.PUBLISHERS_ID);
        if(publisher) {
            let orgs = (publisher.value as any[]).map(pub=>findOrgName(pub)).filter(o=>!!o);
            this.query.set(QueryParameters.PUBLISHERS_ID, orgs);
        }

        this.queryChange.next(this.query);
    }

    onPageSizeChange() {
        this.query.setPageSize(this.pageSize);
        this.queryChange.next(this.query);
    }

    executeQuery() {
        this.loading = true;
        this.service.search(this.query)
        .then( response => {
            //Should not have to wrap with zone, but for some reason, the
            // async call (despite using Angular HttpClient under the hood)
            // is happening outside of zone.
            //see: https://github.com/angular/angular/issues/7381
            this._ngZone.run(() => {
                this.loading = false;
                this.error = null;
                this.totalResults = response.totalResults;
                this.results = response;
            });
        })
        .catch( e => {
            this.loading = false;
            this.error = e;
            this.results = [];
            this.totalResults = 0;
            console.log("An error occurred: " + e.message);
        })
    }

    previousPage() {
        let page: number = Math.max(0, this.query.getPage()-1);
        this.query.page(page);
        this.queryChange.next(this.query);
    }

    nextPage() {
        let lastPage = Math.min(this.totalResults / this.query.getPageSize());
        let page:number = Math.min(this.query.getPage()+1, lastPage);
        this.query.page(page);
        this.queryChange.next(this.query);
    }

    /**
     *
     */
    getItemType (item) {
        let org = item.publishers && item.publishers.length ? item.publishers[0] : null;
        if(org && org.orgType) {
            if(~org.orgType.indexOf(" Organization"))
                return org.orgType.replace(' Organization', '');
            return org.orgType;
        }
        return "Other";
    }

    getItemThumbnail(item) {
        return item.publishers && item.publishers.length ?
            (item.publishers[0].thumbnail ?
                item.publishers[0].thumbnail.url : null) : null;
    }

    canImportItem(item) {
        return false;
    }

    /**
     *
     */
    importItem (item) {
    }

}
