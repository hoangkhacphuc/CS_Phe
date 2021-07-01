var tkb = [
    [1,0,0,2,0,0,0],
    [1,0,0,2,0,0,0],
    [1,0,0,0,0,0,0],
    [0,0,0,0,0,0,0],
    [2,0,0,0,0,0,0],
    [2,0,0,0,0,0,0],
    [0,0,1,0,0,0,0],
    [0,0,1,0,0,0,0],
    [0,0,1,0,0,0,0],
    [0,0,0,0,0,0,0]
];

function addtkb()
{
    for (i=0; i< 10; i++)
        for (j=0;j<8;j++)
            if (tkb[i][j] > 0)
            {
                var id = ""+(i+1);
                id += (j+1);
                document.getElementById(id).className = "color"+tkb[i][j];
            }
    document.getElementById('1').className = "color1";
    document.getElementById('2').className = "color2";
}

