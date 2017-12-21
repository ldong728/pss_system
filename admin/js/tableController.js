var TableController = {
    totalPageDisplayer: '.page-total',
    tatalCountDisplayr:'total-count',
    currentPageDiplayer:'.page-now',
    totalPage:0,
    methodName:null,
    handleCallback:null,
    filter:{
        where:{},
        page:0
    },


    setPage:function(page){
        this.filter.page=page;
    },
    addFilter:function(filter){
        if('object'==typeof(filter)){
            for(var i in filter){
                this.filter.where[i]=filter[i];
            }
        }
    },
    setfilter:function(filter){
        if('object'==typeof(filter))
        this.filter.where=filter;
    },
    getList: function (callback) {
        var sCallback=callback||this.handleCallback;
        var _=this;
        if (this.methodName) {
            ajaxPost(this.methodName, this.filter, function (back) {
                var backInf = backHandle(back);
                _.totalPage=parseInt(backInf.page);
                $(_.totalPageDisplayer).text(backInf.page);
                $(_.currentPageDiplayer).text(_.filter.page+1);
                //_.totalCount = backInf.count;
                sCallback(backInf);
            });
        }
    },
    prepareElement:function(){
        var returnData={};
        var classList=[];
        var outArg=arguments;
        $.each(arguments,function(k,v){
            //console.log(v);
            if($(v.toString()).length>0){
                returnData[v]=$(v).clone();
            }
            classList.push(v);
        });

        $.each(classList,function(k,v){
            $(v).remove();
            for(var i in returnData){
                returnData[i].find(v).remove();
            }
        });
        return function(jqueryElement){
            var element=jqueryElement;
            if(1==outArg.length){
                element=outArg[0];
            }
            return returnData[element].clone();
        }
    },




    setPageEvent:function(nextPageSelector,prevPageSelector,eventFunction){
        var _=this;
        var sEventFunction=eventFunction||_.getList;
        var next=nextPageSelector||'#next';
        var prev=prevPageSelector||'#prev';
        $(document).on('click',next,function(){
           if(_.filter.where.page< _.totalPage-1){
               _.filter.where.page++;
               sEventFunction()
           }else{
               console.log('last')
           }
        });
        $(document).on('click',prev,function(){
           if(_.filter.where.page>0){
               _.filter.where.page--;
               sEventFunction()
           }else{
               console.log('first');
           }

        });
    },
    init:function(methodName,contentHangler){
        this.methodName=methodName;
        this.handleCallback=contentHangler;
    }
    //normalHandler:function(data)

};
//TableController.init();