function tb(a)
{
    request= new XMLHttpRequest()
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (request.responseText != "")
            {
                alert(request.responseText);
            }
        }
    };
    request.open("POST", "getKetQua.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    request.send("id="+a);
}