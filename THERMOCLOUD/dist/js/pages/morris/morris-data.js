// Dashboard 1 Morris-chart
$(function () {
    "use strict";

// LINE CHART
        var line = new Morris.Line({
          element: 'morris-line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          gridLineColor: '#eef0f2',
          lineColors: ['#5f76e8'],
          lineWidth: 1,
          hideHover: 'auto'
        });

 });    

 $('ul.nav a').on('shown.bs.tab', function (e) {
  //line.redraw();
  document.getElementById('graph1').style.opacity='1';
});

// $('ul.nav a').on('shown.bs.tab', function (e) {
//   var types = $(this).attr("data-identifier");
//   var typesArray = types.split(",");
//   $.each(typesArray, function (key, value) {
//       eval(value + ".redraw()");
//   })
// });