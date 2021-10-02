function selectTab(){
    if(document.getElementById("mySelect").value=="C") {
        $("tr[title = 'C']").show();
        $("tr[title != 'C']").hide();
    }
    else if(document.getElementById("mySelect").value=="C++") {
        $("tr[title = 'C++']").show();
        $("tr[title != 'C++']").hide();
    }
    else if(document.getElementById("mySelect").value=="Java") {
        $("tr[title = 'Java']").show();
        $("tr[title != 'Java']").hide();
    }
    else if(document.getElementById("mySelect").value=="JavaScript") {
        $("tr[title = 'JavaScript']").show();
        $("tr[title != 'JavaScript']").hide();
    }
    else if(document.getElementById("mySelect").value=="Python") {
        $("tr[title = 'Python']").show();
        $("tr[title != 'Python']").hide();
    }
    else if(document.getElementById("mySelect").value=="Scala") {
        $("tr[title = 'Scala']").show();
        $("tr[title != 'Scala']").hide();
    }
    else if(document.getElementById("mySelect").value=="Tutti") {
        $("tr[title != 'Tutti']").show();
    }
    $("tr[title = 'Intest']").show();
}