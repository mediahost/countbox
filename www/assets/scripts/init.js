var basePath = '{{$basePath}}';

jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout

    ComponentsPickers.init();
    HtmlEditors.init();
    ComponentsFormTools.init();
});