var data
var text
var chosen
var curr

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    text = ev.target.innerHTML;
    ev.dataTransfer.setData("text", ev.target.id);
}

function selectText(item) {
    if (data != null && data[1] != null) {
        var tmp = data[1].split(" ");
        curr = tmp[0];
    }
    data = new Array(2);
    data[0] = $(item).attr("id");
    chosen = item;
}

function drop(ev) {
    if (chosen.draggable) {
        ev.preventDefault();
        var element;
        if (text.length > 28) {
            var changed = text.substr(0, 21);
            changed +=  "..." + "<br />";
            element = ev.dataTransfer.getData("text");
            var nodeCopy = document.getElementById(element).cloneNode(true);
            var tmp = data[1].split(" ");
            nodeCopy.id += " from " + tmp[0];
            nodeCopy.innerHTML = changed;
            ev.target.appendChild(nodeCopy);
            $(chosen).css('opacity','0.5');
            chosen.setAttribute('draggable', false);
        } else {
            element = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(element));
            var temp = document.getElementById(element).id.split(" ");
            var tmp = data[1].split(" ");
            document.getElementById(element).id = temp[0] + " from " + tmp[0];
        }
    }
}

function selectBox(item) {
    data[1] = $(item).attr("id");
    if (curr != null) {
        data[1] += " from " + curr;
    }
    console.log(data[0]);
    console.log(data[1]);
    var realid = data[0].split(" ");
    var real_group_id = data[1];
    var real_group = data[1].split(" ");
    if (real_group[0] == 0) {
        real_group_id = "remove" + real_group[2];
    }
    if (real_group[2] == 0) {
        real_group_id = real_group[0];
    }
    $.ajax({
        url: 'experiment.php',
        type: 'POST',
        data: {
            'text_id': realid[0],
            'box_id': real_group_id
        },
        success: function (response) {
            //alert(response)
        },
        error: function(xhr, textStatus, error){
            //console.log(xhr.statusText);
            //console.log(textStatus);
            //console.log(error);
        }});
}

function dropBack(ev) {
    var el = document.getElementById(data[0]);
    el.parentNode.removeChild(el);
    var id = data[0].substr(0, data[0].indexOf(' '));
    $(document.getElementById(id)).css('opacity','1.0');
    document.getElementById(id).setAttribute('draggable', true);
    data[1] = 0;
    if (curr != null) {
        data[1] += " remove " + curr;
    }
    console.log(data[0]);
    console.log(data[1]);
    var realid = data[0].split(" ");
    var real_group_id = data[1];
    var real_group = data[1].split(" ");
    if (real_group[0] == 0) {
        real_group_id = "remove " + real_group[2];
    }
    if (real_group[2] == 0) {
        real_group_id = real_group[0];
    }
    console.log(real_group_id);
    $.ajax({
        url: 'experiment.php',
        type: 'POST',
        data: {
            'text_id': realid[0],
            'box_id': real_group_id
        },
        success: function (response) {
            //alert(response)
        },
        error: function(xhr, textStatus, error){
            //console.log(xhr.statusText);
            //console.log(textStatus);
            //console.log(error);
        }});
}

/*var data
var text
var chosen

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    text = ev.target.innerHTML;
    ev.dataTransfer.setData("text", ev.target.id);
    console.log(" target id " + ev.target.id);
}

function selectText(item) {
    data = new Array(2);
    data[0] = $(item).attr("id");
    chosen = item;
}

function drop(ev) {
    if (chosen.draggable) {
        ev.preventDefault();
        var content = text.split(" ");
        console.log("here");
        var element;
        if (content.length > 4) {
            var changed = content[0] + " " + content[1] + " " + content[2] + " ..." + "<br />";
            element = ev.dataTransfer.getData("text");
            var nodeCopy = document.getElementById(element).cloneNode(true);
            nodeCopy.id += "remove " + data[1];
            nodeCopy.innerHTML = changed;
            ev.target.appendChild(nodeCopy);
            $(chosen).css('opacity','0.5');
            chosen.setAttribute('draggable', false);
        } else {
            element = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(element));
            var temp = document.getElementById(element).id.split(" ");
            document.getElementById(element).id = temp[0] + " from " + data[1];
        }
    }
}

function selectBox(item) {
    if (data[1] == null) {
        data[1] = $(item).attr("id");
        console.log(data[0]);
        console.log(data[1]);
        var realid = data[0].split(" ");
        $.ajax({
            url: 'experiment.php',
            type: 'POST',
            data: {
                'text_id': realid[0],
                'box_id': data[1]
            },
            success: function (response) {
                //alert(response)
            },
            error: function(xhr, textStatus, error){
                //console.log(xhr.statusText);
                //console.log(textStatus);
                //console.log(error);
            }});
    }
}

function dropBack(ev) {
    var el = document.getElementById(data[0]);
    el.parentNode.removeChild(el);
    var id = data[0].substr(0, data[0].indexOf(' '));
    $(document.getElementById(id)).css('opacity','1.0');
    document.getElementById(id).setAttribute('draggable', true);
    data[1] = 0;
    console.log(data[0]);
    console.log(data[1]);
    var realid = data[0].split(" ");
    $.ajax({
        url: 'experiment.php',
        type: 'POST',
        data: {
            'text_id': realid[0],
            'box_id': data[1]
        },
        success: function (response) {
            //alert(response)
        },
        error: function(xhr, textStatus, error){
            //console.log(xhr.statusText);
            //console.log(textStatus);
            //console.log(error);
        }});
}
*/