function minipkg(action, host = '', pkg, repo, branch = '', user, bulk)
{
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            if (bulk !== true) {
                document.location.reload();
            }
        }
    }
    xmlhttp.open("GET","minipkg.php?action="+action+"&host="+host+"&pkg="+pkg+"&repo="+repo+"&branch="+branch+"&user="+user,false);
    xmlhttp.send();
}
function minirepo(action, host = '', pkg, repo, branch = '', user, bulk)
{
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            if (bulk !== true) {
                document.location.reload();
            }
        }
    }
    xmlhttp.open("GET","minirepo.php?action="+action+"&host="+host+"&pkg="+pkg+"&repo="+repo+"&branch="+branch+"&user="+user,false);
    xmlhttp.send();
}
