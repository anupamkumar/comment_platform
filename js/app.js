function toHTML(plainText) {
    if (plainText.indexOf("<script") != -1) {
        alert("Script tags are not allowed.");
        return null;
    }

    var theOutput = "";
    for (i = 0; i < plainText.length; i++) {
        if (plainText[i] == '\n') {
            theOutput = theOutput + "\r<br>";
        } else {
            theOutput = theOutput + plainText[i];
        }
    }
    return theOutput;
}

function getStyleRule(name) {
    for (var i = 0; i < document.styleSheets.length; i++) {
        var ix, sheet = document.styleSheets[i];
        for (ix = 0; ix < sheet.cssRules.length; ix++) {
            if (sheet.cssRules[ix].selectorText === name)
                return sheet.cssRules[ix].style;
        }
    }
    return null;
}

function fnRep(myId) {
    var pc = "#postedComment" + myId;
    var rl = parseInt($(pc).attr('reply-level'));
    rl++;
    var bc = 0;
    $(pc).append('<p><blockquote id="' + myId + 'x' + bc + '"></blockquote></p>');
    for (bc = 1; bc < rl; bc++) {
        if ((bc % 3) == 0) {
            var c = getStyleRule('.container');
            var cw = parseInt(c.width);
            cw = cw + 20;
            c.width = cw + "%";
        }
        $('#' + myId + 'x' + (bc - 1)).append('<blockquote id="' + myId + 'x' + bc + '"></blockquote>');
    }
    $('#' + myId + 'x' + (rl - 1)).append('<div id="postedComment' + cid + '" reply-level=' + rl + '><textarea id="replycomment"></textarea><br><input type="button" id="rdt' + cid + '" value="Submit" onclick="fnPutR(' + myId + ')"/>');
    $("#replycomment").focus();
    $('html, body').animate({
        scrollTop: $("#replycomment").offset().top
    }, 500);
}

function fnEd(myId) {
    var t = $("#comm" + myId).text();
    var pc = "#postedComment" + myId;
    $(pc).empty();
    $(pc).append('<textarea id="editcomment">' + t + '</textarea><br/><input type="button" id="sdt' + myId + '" value="Submit" onclick="fnputE(' + myId + ')"/>');
    $("#editcomment").focus();
    $('html, body').animate({
        scrollTop: $("#editcomment").offset().top
    }, 500);
}

function fnD(myId) {
    var pc1 = "#comm" + myId;
    var pc2 = "#controls" + myId;
    $(pc1).empty();
    $(pc1).append("[comment deleted]");
    $(pc2).empty();
    var req = $.ajax({
        url: "components/editReply.php?cmt=[comment deleted]&cid=" + myId,
        type: "GET",
        dataType: "html"
    });
    req.done(function(ajaxOp) {
        $("#op").append(ajaxOp);
    });
}

function fnPutR(myId) {
    var t = toHTML($('#replycomment').val());
    var pc = "#postedComment" + cid;
    $(pc).empty();
    $(pc).append('<p id="u"><i>' + $("#user").text() + ' says:</i></p><p id="comm' + cid + '"></p><div class="none" id="controls' + cid + '"><span><a href="#" id="rep' + cid + '" onclick="fnRep(' + cid + ')">reply</a>&nbsp;</span>&nbsp;<span><a href="#" id="edt' + cid + '" onclick="fnEd(' + cid + ')">edit&nbsp;</a></span>&nbsp;<span><a href="#" id="del' + cid + '" onclick="fnD(' + cid + ')">delete&nbsp;</a></span></div>');
    $('#comm' + cid).append(t);
    cid++;
    var req = $.ajax({
        url: "components/addReply.php?user=" + $("#user").text() + "&cmt=" + t + "&rid=" + myId,
        type: "GET",
        dataType: "html"
    });
    req.done(function(ajaxOp) {
        $("#op").append(ajaxOp);
    });
}

function fnputE(myId) {
    var t = toHTML($('#editcomment').val());
    var pc = "#postedComment" + myId;
    $(pc).empty();
    $(pc).append('<p id="u"><i>' + $("#user").text() + ' says:</i></p><p id="comm' + myId + '"></p><div class="none" id="controls' + myId + '"><span><a href="#" id="rep' + myId + '" onclick="fnRep(' + myId + ')">reply</a>&nbsp;</span>&nbsp;<span><a href="#" id="edt' + myId + '" onclick="fnEd(' + myId + ')">edit&nbsp;</a></span>&nbsp;<span><a href="#" id="del' + myId + '" onclick="fnD(' + myId + ')">delete&nbsp;</a></span></div>');
    $('#comm' + myId).append(t);
    var req = $.ajax({
        url: "components/editReply.php?cmt=" + t + "&cid=" + myId,
        type: "GET",
        dataType: "html"
    });
    req.done(function(ajaxOp) {
        $("#op").append(ajaxOp);
    });
}


var cid = 0;
$(function() {
    var request = $.ajax({
        url: "components/populateComments.php?user=" + $("#user").text(),
        type: "GET",
        dataType: "html"
    });
    request.done(function(ajaxOutput) {
        $("#op").append(ajaxOutput);
        cid = parseInt($("#maxcid").text()) + 1;
    });

    $('#submit').on('click', function() {
        var text = toHTML($('#comment').val());
        $("#op").append('<div id="postedComment' + cid + '" reply-level="0"><p id="u"><i>' + $("#user").text() + ' says:</i></p><p id="comm' + cid + '"></p><div class="none" id="controls' + cid + '"><span><a href="#" id="rep' + cid + '" onclick="fnRep(' + cid + ')">reply</a>&nbsp;</span>&nbsp;<span><a href="#" id="edt' + cid + '" onclick="fnEd(' + cid + ')">edit&nbsp;</a></span>&nbsp;<span><a href="#" id="del' + cid + '" onclick="fnD(' + cid + ')">delete&nbsp;</a></span></div></div>');
        $("#comm" + cid).append(text);
        cid++;
        var req = $.ajax({
            url: "components/addReply.php?user=" + $("#user").text() + "&cmt=" + text + "&rid=0",
            type: "GET",
            dataType: "html"
        });
        req.done(function(ajaxOp) {
            $("#op").append(ajaxOp);
        });
    });
});