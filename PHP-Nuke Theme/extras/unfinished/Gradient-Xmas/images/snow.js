function rnd(){return Math.random();}
function xRnd(){return (rnd()/10);}
function yRnd(){return (2 + 2*( .5 - rnd() ));}
var letitsnow = true;
var flakes = Array("http://www.phpbb2.de/img/snwflk1.gif","http://www.phpbb2.de/img/snwflk2.gif","http://www.phpbb2.de/img/snwflk3.gif","http://www.phpbb2.de/img/snwflk4.gif");
var numflakes = 10;
var T = 50;
var dx, xPos, yPos, am, vx, vy, obj, i;
var winwidth = 640;
var winheight = 480;

function sizeIt()
{
window.winwidth = window.innerWidth?window.innerWidth:document.body.clientWidth;
window.winheight = window.innerHeight?window.innerHeight:document.body.clientHeight;
}

dx = new Array();
xPos = new Array();
yPos = new Array();
sway = new Array();
var swaymax = 20;
vx = new Array();
vy = new Array();
sizeIt();
document.write("<STYLE type=\"text/css\">\n.flk {position:absolute;top:-100;}<\/STYLE>");
for (i = 0; i < numflakes; i++)
{
   var thisflake = "" + flakes[Math.floor(rnd()*flakes.length)];
   dx[i] = 0;

   xPos[i] = rnd()*(window.winwidth-30) +10;
   yPos[i] = rnd()*window.winheight;
   sway[i] = rnd()*swaymax;
   vx[i] = xRnd();
   vy[i] = yRnd();
   document.write("<div id=\"f"+ i +"\" class=\"flk\"><img src=\"");
   document.write(thisflake + "\" border=\"0\"><\/div>");
}


function snowMove(id,left,top)
{
   obj = document.getElementById?document.getElementById(id).style:
   document.all?document.all[id].style:
   document.layers?document.layers[id]:null;
   if (obj)
   {
      obj.left=left;
      obj.top=top;
   }
}

function snowSwitch(s)
{
   if ( s == "on" )
   {
      if ( window.letitsnow != true )
      {
         window.letitsnow = true;
         doSnow();
      }
   } else if ( s == "off" )
   {
      window.letitsnow = false;
      hideSnow();
   }
}

function hideSnow()
{
   for (i = 0; i < numflakes; ++ i) {
      snowMove("f"+i,-100,-100);
   }
}

function doSnow() {
if (letitsnow){
   sizeIt();
   delta = (window.pageYOffset!=null)?window.pageYOffset:document.body.scrollTop;
   for (i = 0; i < numflakes; ++ i) {
      yPos[i] += vy[i];
      if (yPos[i] > window.winheight+delta-50) {
         xPos[i] = rnd()*(window.winwidth-sway[i]-30);
         yPos[i] = delta;
         vx[i] = xRnd();
         vy[i] = yRnd();
      }
      dx[i] += vx[i];
      snowMove("f"+i,xPos[i]+sway[i]*Math.cos(dx[i]),yPos[i]);
   }
   setTimeout("doSnow()", T);
}
}


window.onload=doSnow;
