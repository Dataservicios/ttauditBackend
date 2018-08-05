AmCharts.AmSerialChart=AmCharts.Class({inherits:AmCharts.AmRectangularChart,construct:function(a){this.type="serial";AmCharts.AmSerialChart.base.construct.call(this,a);this.cname="AmSerialChart";this.theme=a;this.createEvents("changed");this.columnSpacing=5;this.columnSpacing3D=0;this.columnWidth=.8;this.updateScrollbar=!0;var b=new AmCharts.CategoryAxis(a);b.chart=this;this.categoryAxis=b;this.zoomOutOnDataUpdate=!0;this.mouseWheelZoomEnabled=this.mouseWheelScrollEnabled=this.rotate=this.skipZoom=
!1;this.minSelectedTime=0;AmCharts.applyTheme(this,a,this.cname)},initChart:function(){AmCharts.AmSerialChart.base.initChart.call(this);this.updateCategoryAxis(this.categoryAxis,this.rotate,"categoryAxis");this.dataChanged&&(this.updateData(),this.dataChanged=!1,this.dispatchDataUpdated=!0);var a=this.chartCursor;a&&(a.updateData(),a.fullWidth&&(a.fullRectSet=this.cursorLineSet));var a=this.countColumns(),b=this.graphs,c;for(c=0;c<b.length;c++)b[c].columnCount=a;this.updateScrollbar=!0;this.drawChart();
this.autoMargins&&!this.marginsUpdated&&(this.marginsUpdated=!0,this.measureMargins())},handleWheelReal:function(a,b){if(!this.wheelBusy){var c=this.categoryAxis,d=c.parseDates,e=c.minDuration(),g=c=1;this.mouseWheelZoomEnabled?b||(c=-1):b&&(c=-1);var f=this.chartData.length,l=this.lastTime,k=this.firstTime;0>a?d?(f=this.endTime-this.startTime,d=this.startTime+c*e,e=this.endTime+g*e,0<g&&0<c&&e>=l&&(e=l,d=l-f),this.zoomToDates(new Date(d),new Date(e))):(0<g&&0<c&&this.end>=f-1&&(c=g=0),d=this.start+
c,e=this.end+g,this.zoomToIndexes(d,e)):d?(f=this.endTime-this.startTime,d=this.startTime-c*e,e=this.endTime-g*e,0<g&&0<c&&d<=k&&(d=k,e=k+f),this.zoomToDates(new Date(d),new Date(e))):(0<g&&0<c&&1>this.start&&(c=g=0),d=this.start-c,e=this.end-g,this.zoomToIndexes(d,e))}},validateData:function(a){this.marginsUpdated=!1;this.zoomOutOnDataUpdate&&!a&&(this.endTime=this.end=this.startTime=this.start=NaN);AmCharts.AmSerialChart.base.validateData.call(this)},drawChart:function(){AmCharts.AmSerialChart.base.drawChart.call(this);
var a=this.chartData;if(AmCharts.ifArray(a)){var b=this.chartScrollbar;b&&b.draw();if(0<this.realWidth&&0<this.realHeight){var a=a.length-1,c,b=this.categoryAxis;if(b.parseDates&&!b.equalSpacing){if(b=this.startTime,c=this.endTime,isNaN(b)||isNaN(c))b=this.firstTime,c=this.lastTime}else if(b=this.start,c=this.end,isNaN(b)||isNaN(c))b=0,c=a;this.endTime=this.startTime=this.end=this.start=void 0;this.zoom(b,c)}}else this.cleanChart();this.dispDUpd();this.chartCreated=!0},cleanChart:function(){AmCharts.callMethod("destroy",
[this.valueAxes,this.graphs,this.categoryAxis,this.chartScrollbar,this.chartCursor])},updateCategoryAxis:function(a,b,c){a.chart=this;a.id=c;a.rotate=b;a.axisRenderer=AmCharts.RecAxis;a.guideFillRenderer=AmCharts.RecFill;a.axisItemRenderer=AmCharts.RecItem;a.setOrientation(!this.rotate);a.x=this.marginLeftReal;a.y=this.marginTopReal;a.dx=this.dx;a.dy=this.dy;a.width=this.plotAreaWidth-1;a.height=this.plotAreaHeight-1;a.viW=this.plotAreaWidth-1;a.viH=this.plotAreaHeight-1;a.viX=this.marginLeftReal;
a.viY=this.marginTopReal;a.marginsChanged=!0},updateValueAxes:function(){AmCharts.AmSerialChart.base.updateValueAxes.call(this);var a=this.valueAxes,b;for(b=0;b<a.length;b++){var c=a[b],d=this.rotate;c.rotate=d;c.setOrientation(d);d=this.categoryAxis;if(!d.startOnAxis||d.parseDates)c.expandMinMax=!0}},updateData:function(){this.parseData();var a=this.graphs,b,c=this.chartData;for(b=0;b<a.length;b++)a[b].data=c;0<c.length&&(this.firstTime=this.getStartTime(c[0].time),this.lastTime=this.getEndTime(c[c.length-
1].time))},getStartTime:function(a){var b=this.categoryAxis;return AmCharts.resetDateToMin(new Date(a),b.minPeriod,1,b.firstDayOfWeek).getTime()},getEndTime:function(a){var b=AmCharts.extractPeriod(this.categoryAxis.minPeriod);return AmCharts.changeDate(new Date(a),b.period,b.count,!0).getTime()-1},updateMargins:function(){AmCharts.AmSerialChart.base.updateMargins.call(this);var a=this.chartScrollbar;a&&(this.getScrollbarPosition(a,this.rotate,this.categoryAxis.position),this.adjustMargins(a,this.rotate))},
updateScrollbars:function(){AmCharts.AmSerialChart.base.updateScrollbars.call(this);this.updateChartScrollbar(this.chartScrollbar,this.rotate)},zoom:function(a,b){var c=this.categoryAxis;c.parseDates&&!c.equalSpacing?this.timeZoom(a,b):this.indexZoom(a,b);this.updateLegendValues()},timeZoom:function(a,b){var c=this.maxSelectedTime;isNaN(c)||(b!=this.endTime&&b-a>c&&(a=b-c,this.updateScrollbar=!0),a!=this.startTime&&b-a>c&&(b=a+c,this.updateScrollbar=!0));var d=this.minSelectedTime;if(0<d&&b-a<d){var e=
Math.round(a+(b-a)/2),d=Math.round(d/2);a=e-d;b=e+d}var g=this.chartData,e=this.categoryAxis;if(AmCharts.ifArray(g)&&(a!=this.startTime||b!=this.endTime)){var f=e.minDuration(),d=this.firstTime,l=this.lastTime;a||(a=d,isNaN(c)||(a=l-c));b||(b=l);a>l&&(a=l);b<d&&(b=d);a<d&&(a=d);b>l&&(b=l);b<a&&(b=a+f);b-a<f/5&&(b<l?b=a+f/5:a=b-f/5);this.startTime=a;this.endTime=b;c=g.length-1;f=this.getClosestIndex(g,"time",a,!0,0,c);g=this.getClosestIndex(g,"time",b,!1,f,c);e.timeZoom(a,b);e.zoom(f,g);this.start=
AmCharts.fitToBounds(f,0,c);this.end=AmCharts.fitToBounds(g,0,c);this.zoomAxesAndGraphs();this.zoomScrollbar();a!=d||b!=l?this.showZB(!0):this.showZB(!1);this.updateColumnsDepth();this.dispatchTimeZoomEvent()}},updateAfterValueZoom:function(){this.zoomAxesAndGraphs();this.zoomScrollbar();this.updateColumnsDepth()},indexZoom:function(a,b){var c=this.maxSelectedSeries;isNaN(c)||(b!=this.end&&b-a>c&&(a=b-c,this.updateScrollbar=!0),a!=this.start&&b-a>c&&(b=a+c,this.updateScrollbar=!0));if(a!=this.start||
b!=this.end){var d=this.chartData.length-1;isNaN(a)&&(a=0,isNaN(c)||(a=d-c));isNaN(b)&&(b=d);b<a&&(b=a);b>d&&(b=d);a>d&&(a=d-1);0>a&&(a=0);this.start=a;this.end=b;this.categoryAxis.zoom(a,b);this.zoomAxesAndGraphs();this.zoomScrollbar();0!==a||b!=this.chartData.length-1?this.showZB(!0):this.showZB(!1);this.updateColumnsDepth();this.dispatchIndexZoomEvent()}},updateGraphs:function(){AmCharts.AmSerialChart.base.updateGraphs.call(this);var a=this.graphs,b;for(b=0;b<a.length;b++){var c=a[b];c.columnWidthReal=
this.columnWidth;c.categoryAxis=this.categoryAxis;AmCharts.isString(c.fillToGraph)&&(c.fillToGraph=this.getGraphById(c.fillToGraph))}},updateColumnsDepth:function(){var a,b=this.graphs,c;AmCharts.remove(this.columnsSet);this.columnsArray=[];for(a=0;a<b.length;a++){c=b[a];var d=c.columnsArray;if(d){var e;for(e=0;e<d.length;e++)this.columnsArray.push(d[e])}}this.columnsArray.sort(this.compareDepth);if(0<this.columnsArray.length){b=this.container.set();this.columnSet.push(b);for(a=0;a<this.columnsArray.length;a++)b.push(this.columnsArray[a].column.set);
c&&b.translate(c.x,c.y);this.columnsSet=b}},compareDepth:function(a,b){return a.depth>b.depth?1:-1},zoomScrollbar:function(){var a=this.chartScrollbar,b=this.categoryAxis;a&&this.updateScrollbar&&a.enabled&&(a.dragger.stop(),b.parseDates&&!b.equalSpacing?a.timeZoom(this.startTime,this.endTime):a.zoom(this.start,this.end),this.updateScrollbar=!0)},updateTrendLines:function(){var a=this.trendLines,b;for(b=0;b<a.length;b++){var c=a[b],c=AmCharts.processObject(c,AmCharts.TrendLine,this.theme);a[b]=c;
c.chart=this;c.id||(c.id="trendLineAuto"+b+"_"+(new Date).getTime());AmCharts.isString(c.valueAxis)&&(c.valueAxis=this.getValueAxisById(c.valueAxis));c.valueAxis||(c.valueAxis=this.valueAxes[0]);c.categoryAxis=this.categoryAxis}},zoomAxesAndGraphs:function(){if(!this.scrollbarOnly){var a=this.valueAxes,b;for(b=0;b<a.length;b++)a[b].zoom(this.start,this.end);a=this.graphs;for(b=0;b<a.length;b++)a[b].zoom(this.start,this.end);this.zoomTrendLines();(b=this.chartCursor)&&b.zoom(this.start,this.end,this.startTime,
this.endTime)}},countColumns:function(){var a=0,b=this.valueAxes.length,c=this.graphs.length,d,e,g=!1,f,l;for(l=0;l<b;l++){e=this.valueAxes[l];var k=e.stackType;if("100%"==k||"regular"==k)for(g=!1,f=0;f<c;f++)d=this.graphs[f],d.tcc=1,d.valueAxis==e&&"column"==d.type&&(!g&&d.stackable&&(a++,g=!0),(!d.stackable&&d.clustered||d.newStack)&&a++,d.columnIndex=a-1,d.clustered||(d.columnIndex=0));if("none"==k||"3d"==k){g=!1;for(f=0;f<c;f++)d=this.graphs[f],d.valueAxis==e&&"column"==d.type&&(d.clustered?(d.tcc=
1,d.newStack&&(a=0),d.hidden||(d.columnIndex=a,a++)):d.hidden||(g=!0,d.tcc=1,d.columnIndex=0));g&&0==a&&(a=1)}if("3d"==k){e=1;for(l=0;l<c;l++)d=this.graphs[l],d.newStack&&e++,d.depthCount=e,d.tcc=a;a=e}}return a},parseData:function(){AmCharts.AmSerialChart.base.parseData.call(this);this.parseSerialData(this.dataProvider)},getCategoryIndexByValue:function(a){var b=this.chartData,c,d;for(d=0;d<b.length;d++)b[d].category==a&&(c=d);return c},handleCursorChange:function(a){this.updateLegendValues(a.index)},
handleCursorZoom:function(a){this.updateScrollbar=!0;this.zoom(a.start,a.end)},handleScrollbarZoom:function(a){this.updateScrollbar=!1;this.zoom(a.start,a.end)},dispatchTimeZoomEvent:function(){if(this.prevStartTime!=this.startTime||this.prevEndTime!=this.endTime){var a={type:"zoomed"};a.startDate=new Date(this.startTime);a.endDate=new Date(this.endTime);a.startIndex=this.start;a.endIndex=this.end;this.startIndex=this.start;this.endIndex=this.end;this.startDate=a.startDate;this.endDate=a.endDate;
this.prevStartTime=this.startTime;this.prevEndTime=this.endTime;var b=this.categoryAxis,c=AmCharts.extractPeriod(b.minPeriod).period,b=b.dateFormatsObject[c];a.startValue=AmCharts.formatDate(a.startDate,b,this);a.endValue=AmCharts.formatDate(a.endDate,b,this);a.chart=this;a.target=this;this.fire(a.type,a)}},dispatchIndexZoomEvent:function(){if(this.prevStartIndex!=this.start||this.prevEndIndex!=this.end){this.startIndex=this.start;this.endIndex=this.end;var a=this.chartData;if(AmCharts.ifArray(a)&&
!isNaN(this.start)&&!isNaN(this.end)){var b={chart:this,target:this,type:"zoomed"};b.startIndex=this.start;b.endIndex=this.end;b.startValue=a[this.start].category;b.endValue=a[this.end].category;this.categoryAxis.parseDates&&(this.startTime=a[this.start].time,this.endTime=a[this.end].time,b.startDate=new Date(this.startTime),b.endDate=new Date(this.endTime));this.prevStartIndex=this.start;this.prevEndIndex=this.end;this.fire(b.type,b)}}},updateLegendValues:function(a){var b=this.graphs,c;for(c=0;c<
b.length;c++){var d=b[c];isNaN(a)?d.currentDataItem=void 0:d.currentDataItem=this.chartData[a].axes[d.valueAxis.id].graphs[d.id]}this.legend&&this.legend.updateValues()},getClosestIndex:function(a,b,c,d,e,g){0>e&&(e=0);g>a.length-1&&(g=a.length-1);var f=e+Math.round((g-e)/2),l=a[f][b];if(c==l)return f;if(1>=g-e){if(d)return e;d=a[g][b];return Math.abs(a[e][b]-c)<Math.abs(d-c)?e:g}return c==l?f:c<l?this.getClosestIndex(a,b,c,d,e,f):this.getClosestIndex(a,b,c,d,f,g)},zoomToIndexes:function(a,b){this.updateScrollbar=
!0;var c=this.chartData;if(c){var d=c.length;0<d&&(0>a&&(a=0),b>d-1&&(b=d-1),d=this.categoryAxis,d.parseDates&&!d.equalSpacing?this.zoom(c[a].time,this.getEndTime(c[b].time)):this.zoom(a,b))}},zoomToDates:function(a,b){this.updateScrollbar=!0;var c=this.chartData;if(this.categoryAxis.equalSpacing){var d=this.getClosestIndex(c,"time",a.getTime(),!0,0,c.length);b=AmCharts.resetDateToMin(b,this.categoryAxis.minPeriod,1);c=this.getClosestIndex(c,"time",b.getTime(),!1,0,c.length);this.zoom(d,c)}else this.zoom(a.getTime(),
b.getTime())},zoomToCategoryValues:function(a,b){this.updateScrollbar=!0;this.zoom(this.getCategoryIndexByValue(a),this.getCategoryIndexByValue(b))},formatPeriodString:function(a,b){if(b){var c=["value","open","low","high","close"],d="value open low high close average sum count".split(" "),e=b.valueAxis,g=this.chartData,f=b.numberFormatter;f||(f=this.nf);for(var l=0;l<c.length;l++){for(var k=c[l],h=0,m=0,q,w,x,r,z,n=0,t=0,p,u,y,A,E,F=this.start;F<=this.end;F++){var v=g[F];if(v&&(v=v.axes[e.id].graphs[b.id])){if(v.values){var B=
v.values[k];if(this.rotate){if(0>v.x||v.x>v.graph.height)B=NaN}else if(0>v.x||v.x>v.graph.width)B=NaN;if(!isNaN(B)){isNaN(q)&&(q=B);w=B;if(isNaN(x)||x>B)x=B;if(isNaN(r)||r<B)r=B;z=AmCharts.getDecimals(h);var D=AmCharts.getDecimals(B),h=h+B,h=AmCharts.roundTo(h,Math.max(z,D));m++;z=h/m}}if(v.percents&&(v=v.percents[k],!isNaN(v))){isNaN(p)&&(p=v);u=v;if(isNaN(y)||y>v)y=v;if(isNaN(A)||A<v)A=v;E=AmCharts.getDecimals(n);B=AmCharts.getDecimals(v);n+=v;n=AmCharts.roundTo(n,Math.max(E,B));t++;E=n/t}}}n={open:p,
close:u,high:A,low:y,average:E,sum:n,count:t};a=AmCharts.formatValue(a,{open:q,close:w,high:r,low:x,average:z,sum:h,count:m},d,f,k+"\\.",this.usePrefixes,this.prefixesOfSmallNumbers,this.prefixesOfBigNumbers);a=AmCharts.formatValue(a,n,d,this.pf,"percents\\."+k+"\\.")}}return a=AmCharts.cleanFromEmpty(a)},formatString:function(a,b,c){var d=b.graph;if(-1!=a.indexOf("[[category]]")){var e=b.serialDataItem.category;if(this.categoryAxis.parseDates){var g=this.balloonDateFormat,f=this.chartCursor;f&&(g=
f.categoryBalloonDateFormat);-1!=a.indexOf("[[category]]")&&(g=AmCharts.formatDate(e,g,this),-1!=g.indexOf("fff")&&(g=AmCharts.formatMilliseconds(g,e)),e=g)}a=a.replace(/\[\[category\]\]/g,String(e))}e=d.numberFormatter;e||(e=this.nf);g=b.graph.valueAxis;(f=g.duration)&&!isNaN(b.values.value)&&(f=AmCharts.formatDuration(b.values.value,f,"",g.durationUnits,g.maxInterval,e),a=a.replace(RegExp("\\[\\[value\\]\\]","g"),f));"date"==g.type&&(g=AmCharts.formatDate(new Date(b.values.value),d.dateFormat,this),
f=RegExp("\\[\\[value\\]\\]","g"),a=a.replace(f,g),g=AmCharts.formatDate(new Date(b.values.open),d.dateFormat,this),f=RegExp("\\[\\[open\\]\\]","g"),a=a.replace(f,g));d="value open low high close total".split(" ");g=this.pf;a=AmCharts.formatValue(a,b.percents,d,g,"percents\\.");a=AmCharts.formatValue(a,b.values,d,e,"",this.usePrefixes,this.prefixesOfSmallNumbers,this.prefixesOfBigNumbers);a=AmCharts.formatValue(a,b.values,["percents"],g);-1!=a.indexOf("[[")&&(a=AmCharts.formatDataContextValue(a,b.dataContext));
return a=AmCharts.AmSerialChart.base.formatString.call(this,a,b,c)},addChartScrollbar:function(a){AmCharts.callMethod("destroy",[this.chartScrollbar]);a&&(a.chart=this,this.listenTo(a,"zoomed",this.handleScrollbarZoom));this.rotate?void 0===a.width&&(a.width=a.scrollbarHeight):void 0===a.height&&(a.height=a.scrollbarHeight);this.chartScrollbar=a},removeChartScrollbar:function(){AmCharts.callMethod("destroy",[this.chartScrollbar]);this.chartScrollbar=null},handleReleaseOutside:function(a){AmCharts.AmSerialChart.base.handleReleaseOutside.call(this,
a);AmCharts.callMethod("handleReleaseOutside",[this.chartScrollbar])}});AmCharts.Cuboid=AmCharts.Class({construct:function(a,b,c,d,e,g,f,l,k,h,m,q,w,x,r,z,n){this.set=a.set();this.container=a;this.h=Math.round(c);this.w=Math.round(b);this.dx=d;this.dy=e;this.colors=g;this.alpha=f;this.bwidth=l;this.bcolor=k;this.balpha=h;this.dashLength=x;this.topRadius=z;this.pattern=r;this.rotate=w;this.bcn=n;w?0>b&&0===m&&(m=180):0>c&&270==m&&(m=90);this.gradientRotation=m;0===d&&0===e&&(this.cornerRadius=q);this.draw()},draw:function(){var a=this.set;a.clear();var b=this.container,
c=b.chart,d=this.w,e=this.h,g=this.dx,f=this.dy,l=this.colors,k=this.alpha,h=this.bwidth,m=this.bcolor,q=this.balpha,w=this.gradientRotation,x=this.cornerRadius,r=this.dashLength,z=this.pattern,n=this.topRadius,t=this.bcn,p=l,u=l;"object"==typeof l&&(p=l[0],u=l[l.length-1]);var y,A,E,F,v,B,D,K,L,P=k;z&&(k=0);var C,G,H,I,J=this.rotate;if(0<Math.abs(g)||0<Math.abs(f))if(isNaN(n))D=u,u=AmCharts.adjustLuminosity(p,-.2),u=AmCharts.adjustLuminosity(p,-.2),y=AmCharts.polygon(b,[0,g,d+g,d,0],[0,f,f,0,0],
u,k,1,m,0,w),0<q&&(L=AmCharts.line(b,[0,g,d+g],[0,f,f],m,q,h,r)),A=AmCharts.polygon(b,[0,0,d,d,0],[0,e,e,0,0],u,k,1,m,0,w),A.translate(g,f),0<q&&(E=AmCharts.line(b,[g,g],[f,f+e],m,q,h,r)),F=AmCharts.polygon(b,[0,0,g,g,0],[0,e,e+f,f,0],u,k,1,m,0,w),v=AmCharts.polygon(b,[d,d,d+g,d+g,d],[0,e,e+f,f,0],u,k,1,m,0,w),0<q&&(B=AmCharts.line(b,[d,d+g,d+g,d],[0,f,e+f,e],m,q,h,r)),u=AmCharts.adjustLuminosity(D,.2),D=AmCharts.polygon(b,[0,g,d+g,d,0],[e,e+f,e+f,e,e],u,k,1,m,0,w),0<q&&(K=AmCharts.line(b,[0,g,d+
g],[e,e+f,e+f],m,q,h,r));else{var M,N,O;J?(M=e/2,u=g/2,O=e/2,N=d+g/2,G=Math.abs(e/2),C=Math.abs(g/2)):(u=d/2,M=f/2,N=d/2,O=e+f/2+1,C=Math.abs(d/2),G=Math.abs(f/2));H=C*n;I=G*n;.1<C&&.1<C&&(y=AmCharts.circle(b,C,p,k,h,m,q,!1,G),y.translate(u,M));.1<H&&.1<H&&(D=AmCharts.circle(b,H,AmCharts.adjustLuminosity(p,.5),k,h,m,q,!1,I),D.translate(N,O))}k=P;1>Math.abs(e)&&(e=0);1>Math.abs(d)&&(d=0);!isNaN(n)&&(0<Math.abs(g)||0<Math.abs(f))?(l=[p],l={fill:l,stroke:m,"stroke-width":h,"stroke-opacity":q,"fill-opacity":k},
J?(k="M0,0 L"+d+","+(e/2-e/2*n),h=" B",0<d&&(h=" A"),AmCharts.VML?(k+=h+Math.round(d-H)+","+Math.round(e/2-I)+","+Math.round(d+H)+","+Math.round(e/2+I)+","+d+",0,"+d+","+e,k=k+(" L0,"+e)+(h+Math.round(-C)+","+Math.round(e/2-G)+","+Math.round(C)+","+Math.round(e/2+G)+",0,"+e+",0,0")):(k+="A"+H+","+I+",0,0,0,"+d+","+(e-e/2*(1-n))+"L0,"+e,k+="A"+C+","+G+",0,0,1,0,0"),C=90):(h=d/2-d/2*n,k="M0,0 L"+h+","+e,AmCharts.VML?(k="M0,0 L"+h+","+e,h=" B",0>e&&(h=" A"),k+=h+Math.round(d/2-H)+","+Math.round(e-I)+
","+Math.round(d/2+H)+","+Math.round(e+I)+",0,"+e+","+d+","+e,k+=" L"+d+",0",k+=h+Math.round(d/2+C)+","+Math.round(G)+","+Math.round(d/2-C)+","+Math.round(-G)+","+d+",0,0,0"):(k+="A"+H+","+I+",0,0,0,"+(d-d/2*(1-n))+","+e+"L"+d+",0",k+="A"+C+","+G+",0,0,1,0,0"),C=180),b=b.path(k).attr(l),b.gradient("linearGradient",[p,AmCharts.adjustLuminosity(p,-.3),AmCharts.adjustLuminosity(p,-.3),p],C),J?b.translate(g/2,0):b.translate(0,f/2)):b=0===e?AmCharts.line(b,[0,d],[0,0],m,q,h,r):0===d?AmCharts.line(b,[0,
0],[0,e],m,q,h,r):0<x?AmCharts.rect(b,d,e,l,k,h,m,q,x,w,r):AmCharts.polygon(b,[0,0,d,d,0],[0,e,e,0,0],l,k,h,m,q,w,!1,r);d=isNaN(n)?0>e?[y,L,A,E,F,v,B,D,K,b]:[D,K,A,E,F,v,y,L,B,b]:J?0<d?[y,b,D]:[D,b,y]:0>e?[y,b,D]:[D,b,y];AmCharts.setCN(c,b,t+"front");AmCharts.setCN(c,A,t+"back");AmCharts.setCN(c,D,t+"top");AmCharts.setCN(c,y,t+"bottom");AmCharts.setCN(c,F,t+"left");AmCharts.setCN(c,v,t+"right");for(y=0;y<d.length;y++)if(A=d[y])a.push(A),AmCharts.setCN(c,A,t+"element");z&&b.pattern(z)},width:function(a){isNaN(a)&&
(a=0);this.w=Math.round(a);this.draw()},height:function(a){isNaN(a)&&(a=0);this.h=Math.round(a);this.draw()},animateHeight:function(a,b){var c=this;c.easing=b;c.totalFrames=Math.round(1E3*a/AmCharts.updateRate);c.rh=c.h;c.frame=0;c.height(1);setTimeout(function(){c.updateHeight.call(c)},AmCharts.updateRate)},updateHeight:function(){var a=this;a.frame++;var b=a.totalFrames;a.frame<=b&&(b=a.easing(0,a.frame,1,a.rh-1,b),a.height(b),setTimeout(function(){a.updateHeight.call(a)},AmCharts.updateRate))},
animateWidth:function(a,b){var c=this;c.easing=b;c.totalFrames=Math.round(1E3*a/AmCharts.updateRate);c.rw=c.w;c.frame=0;c.width(1);setTimeout(function(){c.updateWidth.call(c)},AmCharts.updateRate)},updateWidth:function(){var a=this;a.frame++;var b=a.totalFrames;a.frame<=b&&(b=a.easing(0,a.frame,1,a.rw-1,b),a.width(b),setTimeout(function(){a.updateWidth.call(a)},AmCharts.updateRate))}});AmCharts.CategoryAxis=AmCharts.Class({inherits:AmCharts.AxisBase,construct:function(a){this.cname="CategoryAxis";AmCharts.CategoryAxis.base.construct.call(this,a);this.minPeriod="DD";this.equalSpacing=this.parseDates=!1;this.position="bottom";this.startOnAxis=!1;this.firstDayOfWeek=1;this.gridPosition="middle";this.markPeriodChange=this.boldPeriodBeginning=!0;this.safeDistance=30;this.centerLabelOnFullPeriod=!0;AmCharts.applyTheme(this,a,this.cname)},draw:function(){AmCharts.CategoryAxis.base.draw.call(this);
this.generateDFObject();var a=this.chart.chartData;this.data=a;if(AmCharts.ifArray(a)){var b,c=this.chart;"scrollbar"!=this.id?(AmCharts.setCN(c,this.set,"category-axis"),AmCharts.setCN(c,this.labelsSet,"category-axis"),AmCharts.setCN(c,this.axisLine.axisSet,"category-axis")):this.bcn=this.id+"-";var d=this.start,e=this.labelFrequency,g=0,f=this.end-d+1,l=this.gridCountR,k=this.showFirstLabel,h=this.showLastLabel,m="",m=AmCharts.extractPeriod(this.minPeriod),q=AmCharts.getPeriodDuration(m.period,
m.count),w,x,r,z,n;w=this.rotate;b=this.firstDayOfWeek;var t=this.boldPeriodBeginning,p=AmCharts.resetDateToMin(new Date(a[a.length-1].time+1.05*q),this.minPeriod,1,b).getTime();this.firstTime=c.firstTime;this.endTime>p&&(this.endTime=p);n=this.minorGridEnabled;var u,p=this.gridAlpha;if(this.parseDates&&!this.equalSpacing)this.lastTime=a[a.length-1].time,this.maxTime=AmCharts.resetDateToMin(new Date(this.lastTime+1.05*q),this.minPeriod,1,b).getTime(),this.timeDifference=this.endTime-this.startTime,
this.parseDatesDraw();else if(!this.parseDates){if(this.cellWidth=this.getStepWidth(f),f<l&&(l=f),g+=this.start,this.stepWidth=this.getStepWidth(f),0<l){l=Math.floor(f/l);u=this.chooseMinorFrequency(l);f=g;f/2==Math.round(f/2)&&f--;0>f&&(f=0);var y=0;this.end-f+1>=this.autoRotateCount&&(this.labelRotation=this.autoRotateAngle);for(b=f;b<=this.end+2;b++){t=!1;0<=b&&b<this.data.length?(x=this.data[b],m=x.category,t=x.forceShow):m="";if(n&&!isNaN(u))if(b/u==Math.round(b/u)||t)b/l==Math.round(b/l)||t||
(this.gridAlpha=this.minorGridAlpha,m=void 0);else continue;else if(b/l!=Math.round(b/l)&&!t)continue;f=this.getCoordinate(b-g);r=0;"start"==this.gridPosition&&(f-=this.cellWidth/2,r=this.cellWidth/2);t=!0;a=r;"start"==this.tickPosition&&(a=0,t=!1,r=0);if(b==d&&!k||b==this.end&&!h)m=void 0;Math.round(y/e)!=y/e&&(m=void 0);y++;var A=this.cellWidth;w&&(A=NaN);this.labelFunction&&x&&(m=this.labelFunction(m,x,this));m=AmCharts.fixBrakes(m);q=!1;this.boldLabels&&(q=!0);b>this.end&&"start"==this.tickPosition&&
(m=" ");r=new this.axisItemRenderer(this,f,m,t,A,r,void 0,q,a,!1,x.labelColor,x.className);r.serialDataItem=x;this.pushAxisItem(r);this.gridAlpha=p}}}else if(this.parseDates&&this.equalSpacing){g=this.start;this.startTime=this.data[this.start].time;this.endTime=this.data[this.end].time;this.timeDifference=this.endTime-this.startTime;d=this.choosePeriod(0);e=d.period;w=d.count;a=AmCharts.getPeriodDuration(e,w);a<q&&(e=m.period,w=m.count,a=q);x=e;"WW"==x&&(x="DD");this.stepWidth=this.getStepWidth(f);
l=Math.ceil(this.timeDifference/a)+1;m=AmCharts.resetDateToMin(new Date(this.startTime-a),e,w,b).getTime();this.cellWidth=this.getStepWidth(f);f=Math.round(m/a);d=-1;f/2==Math.round(f/2)&&(d=-2,m-=a);f=this.start;f/2==Math.round(f/2)&&f--;0>f&&(f=0);a=this.end+2;a>=this.data.length&&(a=this.data.length);A=!1;A=!k;this.previousPos=-1E3;20<this.labelRotation&&(this.safeDistance=5);var E=f;if(this.data[f].time!=AmCharts.resetDateToMin(new Date(this.data[f].time),e,w,b).getTime()){var q=0,F=m;for(b=f;b<
a;b++)z=this.data[b].time,this.checkPeriodChange(e,w,z,F)&&(q++,2<=q&&(E=b,b=a),F=z)}n&&1<w&&(u=this.chooseMinorFrequency(w),AmCharts.getPeriodDuration(e,u));if(0<this.gridCountR)for(b=f;b<a;b++)if(z=this.data[b].time,this.checkPeriodChange(e,w,z,m)&&b>=E){f=this.getCoordinate(b-this.start);n=!1;this.nextPeriod[x]&&(n=this.checkPeriodChange(this.nextPeriod[x],1,z,m,x));q=!1;n&&this.markPeriodChange?(n=this.dateFormatsObject[this.nextPeriod[x]],q=!0):n=this.dateFormatsObject[x];m=AmCharts.formatDate(new Date(z),
n,c);if(b==d&&!k||b==l&&!h)m=" ";A?A=!1:(t||(q=!1),f-this.previousPos>this.safeDistance*Math.cos(this.labelRotation*Math.PI/180)&&(this.labelFunction&&(m=this.labelFunction(m,new Date(z),this,e,w,r)),this.boldLabels&&(q=!0),r=new this.axisItemRenderer(this,f,m,void 0,void 0,void 0,void 0,q),n=r.graphics(),this.pushAxisItem(r),n=n.getBBox().width,AmCharts.isModern||(n-=f),this.previousPos=f+n));r=m=z}else isNaN(u)||(this.checkPeriodChange(e,u,z,y)&&(this.gridAlpha=this.minorGridAlpha,f=this.getCoordinate(b-
this.start),n=new this.axisItemRenderer(this,f),this.pushAxisItem(n),y=z),this.gridAlpha=p)}for(b=0;b<this.data.length;b++)if(k=this.data[b])h=this.parseDates&&!this.equalSpacing?Math.round((k.time-this.startTime)*this.stepWidth+this.cellWidth/2):this.getCoordinate(b-g),k.x[this.id]=h;k=this.guides.length;for(b=0;b<k;b++)h=this.guides[b],n=t=n=p=d=NaN,u=h.above,h.toCategory&&(t=c.getCategoryIndexByValue(h.toCategory),isNaN(t)||(d=this.getCoordinate(t-g),h.expand&&(d+=this.cellWidth/2),r=new this.axisItemRenderer(this,
d,"",!0,NaN,NaN,h),this.pushAxisItem(r,u))),h.category&&(n=c.getCategoryIndexByValue(h.category),isNaN(n)||(p=this.getCoordinate(n-g),h.expand&&(p-=this.cellWidth/2),n=(d-p)/2,r=new this.axisItemRenderer(this,p,h.label,!0,NaN,n,h),this.pushAxisItem(r,u))),n=c.dataDateFormat,h.toDate&&(h.toDate=AmCharts.getDate(h.toDate,n,this.minPeriod),this.equalSpacing?(t=c.getClosestIndex(this.data,"time",h.toDate.getTime(),!1,0,this.data.length-1),isNaN(t)||(d=this.getCoordinate(t-g))):d=(h.toDate.getTime()-this.startTime)*
this.stepWidth,r=new this.axisItemRenderer(this,d,"",!0,NaN,NaN,h),this.pushAxisItem(r,u)),h.date&&(h.date=AmCharts.getDate(h.date,n,this.minPeriod),this.equalSpacing?(n=c.getClosestIndex(this.data,"time",h.date.getTime(),!1,0,this.data.length-1),isNaN(n)||(p=this.getCoordinate(n-g))):p=(h.date.getTime()-this.startTime)*this.stepWidth,n=(d-p)/2,t=!0,h.toDate&&(t=!1),r="H"==this.orientation?new this.axisItemRenderer(this,p,h.label,t,2*n,NaN,h):new this.axisItemRenderer(this,p,h.label,!1,NaN,n,h),this.pushAxisItem(r,
u)),(0<d||0<p)&&(d<this.width||p<this.width)&&(d=new this.guideFillRenderer(this,p,d,h),p=d.graphics(),this.pushAxisItem(d,u),h.graphics=p,p.index=b,h.balloonText&&this.addEventListeners(p,h))}this.axisCreated=!0;c=this.x;g=this.y;this.set.translate(c,g);this.labelsSet.translate(c,g);this.positionTitle();(c=this.axisLine.set)&&c.toFront();c=this.getBBox().height;2<c-this.previousHeight&&this.autoWrap&&!this.parseDates&&(this.axisCreated=this.chart.marginsUpdated=!1);this.previousHeight=c},xToIndex:function(a){var b=
this.data,c=this.chart,d=c.rotate,e=this.stepWidth;this.parseDates&&!this.equalSpacing?(a=this.startTime+Math.round(a/e)-this.minDuration()/2,c=c.getClosestIndex(b,"time",a,!1,this.start,this.end+1)):(this.startOnAxis||(a-=e/2),c=this.start+Math.round(a/e));var c=AmCharts.fitToBounds(c,0,b.length-1),g;b[c]&&(g=b[c].x[this.id]);d?g>this.height+1&&c--:g>this.width+1&&c--;0>g&&c++;return c=AmCharts.fitToBounds(c,0,b.length-1)},dateToCoordinate:function(a){return this.parseDates&&!this.equalSpacing?(a.getTime()-
this.startTime)*this.stepWidth:this.parseDates&&this.equalSpacing?(a=this.chart.getClosestIndex(this.data,"time",a.getTime(),!1,0,this.data.length-1),this.getCoordinate(a-this.start)):NaN},categoryToCoordinate:function(a){return this.chart?(a=this.chart.getCategoryIndexByValue(a),this.getCoordinate(a-this.start)):NaN},coordinateToDate:function(a){return this.equalSpacing?(a=this.xToIndex(a),new Date(this.data[a].time)):new Date(this.startTime+a/this.stepWidth)},getCoordinate:function(a){a*=this.stepWidth;
this.startOnAxis||(a+=this.stepWidth/2);return Math.round(a)}});