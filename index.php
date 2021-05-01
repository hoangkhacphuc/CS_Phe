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
        <div class="content" id="step1">
            <input type="file" style="display:none;" id="file" name="file" onchange="getFile()" accept="application/vnd.ms-Excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            <label for="file" class="upload">Upload file Excel</label>
            <div class="up" id="up">
                <div class="bor">
                    <table class="tb-file">
                        <tr id="fileupload">
                        </tr>
                    </table>
                </div>
                <button onclick="btn()">Next Step&nbsp;&nbsp;❯❯❯</button>
            </div>
        </div>
        <div class="pri" id="step2-1" style="display: none;">ƯU TIÊN</div>
        <div class="prior" id="step2-2" style="display: none;">
            <div class="session">
                <div class="item">
                    <input type="radio" id="tatca" value="1" name="check"><label for="tatca">Tất cả</label>
                </div>
                <div class="item">
                    <input type="radio" id="sang" value="2" name="check"><label for="sang">Sáng</label>
                </div>
                <div class="item">
                    <input type="radio" id="chieu" value="3" name="check"><label for="chieu">Chiều</label>
                </div>
            </div>

            <div class="teacher" id="ID_teacher">
                <div class="item">
                    <input type="checkbox" id="1" value="Nguyễn Văn A"><label for="1">Nguyễn Văn ANguyễn Văn A</label>
                </div>
                <div class="item">
                    <input type="checkbox" id="2" value="Nguyễn Văn A"><label for="2">Nguyễn Văn A</label>
                </div>
                <div class="item">
                    <input type="checkbox" id="3" value="Nguyễn Văn A"><label for="3">Nguyễn Văn A</label>
                </div>
                <div class="item">
                    <input type="checkbox" id="4" value="Nguyễn Văn A"><label for="4">Nguyễn Văn A</label>
                </div>
            </div>

            <button onclick="btn2()">Next Step&nbsp;&nbsp;❯❯❯</button>
        </div>
        
    </body>
</html>