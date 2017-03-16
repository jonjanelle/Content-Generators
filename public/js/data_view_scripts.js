/*
 Convert an html table to a json array
 Used to format table data for compatibility with jsCharts.
 table: A table object.
 returns an array of associative arrays
*/
function tableToJson(table){
  //gets rows of table
  var rowLength = table.rows.length;

  var xHead = table.rows.item(0).cells.item(0).innerHTML;
  var yHead = table.rows.item(0).cells.item(1).innerHTML;

  //loops through rows
  var resultArray = Array();
  for (i = 1; i < rowLength; i++){
     var rowCells = table.rows.item(i).cells;
     var row = {};
     row[xHead]=rowCells.item(0).innerHTML;
     row[yHead]=rowCells.item(1).innerHTML;
     resultArray.push(row);
  }

  return resultArray;
}

/**
Wrapper function for an AmCharts.makeChart scatter plot
*/
function createScatterPlot(tableData) {
  var xLab = Object.keys(tableData[0])[0];
  var yLab = Object.keys(tableData[0])[1];
  AmCharts.makeChart("chartdiv",
  {
    "type": "xy",
    "startDuration": 1.5,
    "graphs": [
    {
        "balloonText": xLab+":<b>[[x]]</b> "+yLab+":<b>[[y]]</b>",
        "bullet": "circle",
        "id": "AmGraph-1",
        "lineAlpha": 0,
        "lineColor": "#0000FF",
        "xField": xLab,
        "yField": yLab
    }
    ],
    "guides": [],
    "valueAxes": [
      {
        "id": "ValueAxis-1",
        "axisAlpha": 0
      },
      {
        "id": "ValueAxis-2",
        "position": "bottom",
        "axisAlpha": 0
      }
    ],
    "allLabels": [],
    "balloon": {},
    "titles": [],
    "dataProvider": tableData
  });
}

/*
 * Update the innerHTML of the target_id to the value of source_id
 */
function sliderTextUpdate(source_id, target_id) {
  console.log(source_id);
  var source = document.getElementById(source_id);
  var target = document.getElementById(target_id);
  target.innerHTML=source.value;
}

function setPatternType(optionsId, selectedName)
{
    var options = document.getElementById(optionsId);
    for (var i = 0; i < options.options.length; i++){
      if (options.options[i]==selectedName){
        options.options[i].setAttribute("selected","true");
      }
    }
}


//Draw a scatter plot if data has been generated
var table = document.getElementById('main-table');
if (table.rows.length>0){
  createScatterPlot(tableToJson(table));
}
