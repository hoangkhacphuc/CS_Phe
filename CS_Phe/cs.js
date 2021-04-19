function getFile() {
    var x = document.getElementById("upfile");
    var txt = "";
    var size = 0;
    if ('files' in x) {
        if (x.files.length != 0)
            {
            for (var i = 0; i < x.files.length; i++)
            {
                var file = x.files[i];
                if ('name' in file) {
                    txt += "<td>" + file.name + "</td>";
                }
                if ('size' in file) {
                    size = file.size
                    txt += "<td>" + file.size + " bytes</td>";
                    if (!Upload(file.name))
                    {
                        txt += "<td><div class='sansang' style='color: red'>Please upload a valid Excel file</div></td>";
                    }
                        
                    else if (size <= 51200)
                        txt += "<td><div class='sansang'>Done</div></td>";
                    else txt += "<td><div class='sansang' style='color: red'>Size is too big</div></td>";
                }
            }
        }
    }
    document.getElementById("up").style = "display: block";
    document.getElementById("fileupload").innerHTML = txt;
  }

  function Upload(name) {
    name = name.toLowerCase();
    
    if (name.lastIndexOf(".xlsx") == name.length - 6 || name.lastIndexOf(".xls") == name.length - 5)
        return true;
    return false;
};