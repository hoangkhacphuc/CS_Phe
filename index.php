<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="cs.css">
        <script src="cs.js"></script>
        <link href="lg.png" rel="shortcut icon" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="content">
            <input type="file" style="display:none;" id="file" name="file" onchange="getFile()" accept="application/vnd.ms-Excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            <label for="file" class="upload">Upload file Excel</label>
            <div class="up" id="up">
                <div class="bor">
                    <table class="tb-file">
                        <tr id="fileupload">
                        </tr>
                    </table>
                </div>
                <button onclick="btn()"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;Submit</button>
            </div>
        </div>
    </body>
</html>