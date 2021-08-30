<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="vis-network.min.js"></script>
<link href="vis-network.min.css" rel="stylesheet" type="text/css" />
<head>
<style type="text/css">
#mynetwork {
    width: 1000px;
    height: 1000px;
    border: 1px solid lightgray;
    background:#d1d1d1;
}
p {
    max-width:600px;
}
</style>
</head>
<body>
   <p>Date of interest: <input type="text" id="datepicker" value="2019-08-05"></p>
   Please enter terms of interest
   <input type="text" value= "breakfast" size="30" id="terms"> 
   <button id="generate"> Generate graph </button>
   <div id="mynetwork"></div>
</body>

<script>
var nodes = new vis.DataSet();
var edges = new vis.DataSet();
var nodeId = 1; // unique Node ID for each.
$("#generate").click(function() {
    var t = $('#terms').val();
    var d = $('#datepicker').val();
    $.get("getRecords.php", {
            terms: t,
            date: d
        })
    .done(function(data) {
    var feedbackRecords = data.split('<br>');
    // count number of terms entered by the user
    var termsSplit = t.split(',');
    // for each indivudal term entered by the user
    for (var i = 0; i < termsSplit.length; i++) {
        var singleTerm = termsSplit[i].trim();
        console.log("running graph for " + singleTerm);
        generateGraphForTerm(singleTerm);
    }
    // main function for generating a graph for
    // a specific term       
    function generateGraphForTerm(singleT) {
        var connections = new Array();
        var parentNode = nodeId;
        nodes.add({
            id: nodeId,
            label: singleT,
            font: {
                size: 16,
                color: 'black',
                face: 'arial'
            }
        });
        nodeId++;
        // for each row in the data set we are working with.
        for (var i = 0; i < feedbackRecords.length; i++) {
            console.log("NodeiD " + nodeId);
            var termCount = 0;
            var normalRecord = false;
            for (var y = 0; y < termsSplit.length; y++) {
                console.log("looking in" + feedbackRecords[i]);
                if (feedbackRecords[i].indexOf(termsSplit[y]) > -1) {
                    termCount++;
                    console.log("found occurrence for " + termsSplit[y]);
                }
            }
            console.log("term count " + termCount);
            if (termCount < termsSplit.length) {
                normalRecord = true;
            }
            if (normalRecord == true) {
                if (feedbackRecords[i].indexOf(singleT) > -1) {
                    nodes.add({
                        id: nodeId,
                        label: feedbackRecords[i],
                        font: {
                            size: 11,
                            color: 'black',
                            face: 'arial'
                        }
                    });
                    console.log(nodeId + feedbackRecords[i]);
                    connections.push(nodeId);
                }

                nodeId++;
            } else {
                nodes.add({
                    id: nodeId,
                    label: feedbackRecords[i],
                    font: {
                        size: 11,
                        color: 'red',
                        face: 'arial'
                    }
                });
                console.log(nodeId + feedbackRecords[i]);
                connections.push(nodeId);
                nodeId++;
            }
        }
        // make edges
        for (var node = 0; node < connections.length; node++) {
            var leftNode = connections[node];
            console.log("connected nodes" + leftNode + " to " + parentNode);
            edges.add({
                from: leftNode,
                to: parentNode
            });
        }
    } // function
    
    // create a network
    var container = document.getElementById('mynetwork');
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {
        nodes: {
            shape: 'dot',
            size: 10
        }
    };
    var network = new vis.Network(container, data, options);
});
});
$(function() {
    $("#datepicker").datepicker();
    $("#datepicker").datepicker("option", "dateFormat", 'yy-mm-dd');
});
  </script>

 
 




