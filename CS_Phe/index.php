<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="cs.css">
        <script src="cs.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="content">
            <input type="file" style="display:none;" id="upfile" onchange="getFile()">
            <label for="upfile" class="upload">Upload file Excel</label>
            <div class="up" id="up">
                <table class="tb-file">
                    <tr>
                        <td>Name</td>
                        <td>Size</td>
                        <td>Status</td>
                    </tr>
                    <tr id="fileupload">
                        
                    </tr>
                </table>
                <button><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;Submit</button>
            </div>
        </div>
    </body>
</html>