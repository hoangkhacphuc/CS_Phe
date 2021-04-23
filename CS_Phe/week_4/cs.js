function getFile() {
    var x = document.getElementById("file");
    var txt = "";
    var size = 0;
    if ('files' in x) {
        if (x.files.length != 0)
            {
            for (var i = 0; i < x.files.length; i++)
            {
                var file = x.files[i];
                if ('name' in file) {
                    txt += "<td><div class='item'>" + file.name + "</div></td>";
                }
                if ('size' in file) {
                    size = file.size
                    txt += "<td><div class='item'>" + file.size + " bytes</div></td>";
                    if (!Upload(file.name))
                    {
                        txt += "<td><div class='item'><div class='sansang' style='color: red'>Please upload a valid Excel file</div></div></td>";
                    }
                        
                    else if (size <= 51200)
                    {
                        txt += "<td><div class='item'><div class='sansang'>Done</div></div></td>";
                        selectedFile = event.target.files[0];
                    }
                        
                    else txt += "<td><div class='item'><div class='sansang' style='color: red'>Size is too big</div></div></td>";
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

let selectedFile;
console.log(window.XLSX);
//document.getElementById('upfile').addEventListener("change", (event) => {
//    selectedFile = event.target.files[0];
//})

let data=[{
    "name":"jayanth",
    "data":"scd",
    "abc":"sdef"
}]

function btn()
{
    XLSX.utils.json_to_sheet(data, 'out.xlsx');
    if(selectedFile){
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(selectedFile);
        fileReader.onload = (event)=>{
         let data = event.target.result;
         let workbook = XLSX.read(data,{type:"binary"});
         console.log(workbook);
         workbook.SheetNames.forEach(sheet => {
              let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
              var val = JSON.stringify(rowObject,undefined,4);
              document.getElementById("jsondata").innerHTML = val;
         });
        }
    }
}

function POST(val)
{
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        alert("OK");
    }
    };
    xmlhttp.open("POST", "read.php?val=" + val, true);
    xmlhttp.send();
}