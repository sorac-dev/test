<?php 
   session_start();
   $currentCookieParams = session_get_cookie_params();  
   $sidvalue = session_id();  
   setcookie(  
       'PHPSESSID',//name  
       $sidvalue,//value  
       0,//expires at end of session  
       $currentCookieParams['path'],//path  
       $currentCookieParams['domain'],//domain  
       true //secure  
   );
   //exit('VSINCOMPILAR');
   if(empty($_SESSION['keko']) || empty($_SESSION['idkeko']) || empty($_GET['ik'])) exit('logout');
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>KEKOCITY WEBCAM</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <style type="text/css">
         body {
         padding:0;
         margin: 0;
         }
         article {
         display: block;
         max-width: 1800px;
         min-width: 720px;
         width: 100%;
         }
         article {
         margin: 0;
         padding: 0;
         }  
         .media-container, .media-container * {
         margin: 0;
         padding: 0;
         -webkit-user-select: none;
         -moz-user-select: none;
         -o-user-select: none;
         user-select: none;
         }
         .media-container, .media-container * {
         -moz-transition: all .5s ease-in-out;
         -ms-transition: all .5s ease-in-out;
         -o-transition: all .5s ease-in-out;
         -webkit-transition: all .5s ease-in-out;
         transition: all .5s ease-in-out;
         }
         .media-container {
         height: 100%;
         width: 100%;
         display: inline-block;
         border: 0;
         border-radius: 4px;
         overflow: hidden;
         vertical-align: top;
         }
         .media-box {
         height: 100%;
         width: 100%;
         background: url(../img/logobig.png) center black;
         margin: 1px;
         }
         .media-controls, .volume-control {
         margin-top: 2px;
         position: absolute;
         margin-left: 5px;
         z-index: 100;
         opacity: 0;
         }
         .media-controls .control, .volume-control .control {
         width: 35px;
         height: 35px;
         background-position: center center;
         background-repeat: no-repeat;
         float: left;
         background-color: rgba(255, 255, 255, 0.84);
         }
         .media-controls .control:first-child {
         border-bottom-left-radius: 5px;
         }
         .volume-control .control:first-child {
         border-top-left-radius: 5px;
         }
         .media-controls .control:hover, .media-controls .selected, .volume-control .control:hover {
         background-color: rgba(255, 255, 255, 0.74);
         }
         .media-controls .control:active, .media-container .selected, .volume-control .control:active {
         background-color: rgba(255, 255, 255, 0.44)!important;
         }
         .mute-audio {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwgAADsIBFShKgAAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAACsUlEQVRYR92Xu2siURTGp0hnJRgVGVNtEcHOiI2taWIa3Vgpgu4qiKBoCpOgxgdofD8QTFYUXMRSRLstt9xyy/0Tttxyi9kz17mXq7majFED+8EH+p2Zub+5j4NygiC8q/8PDQaDn9LHw6rf739Sq9UCthQfRk9PT2Rg7Ha7/U0q71erA2OXy+X9AgQ/B3KsgbFZADc3N25clyL5SiaTKnqgdW40Gs8A4vE4ARD9+Pj4XSq9Ts1m8xf9gE0uFosIYDwezyaTCXnjVqvVpq+T4oWur6/5UChEiuFweOkinL/GeAnoDD0ENJ1Of7ByTqFQ8HQB+/7+vi3WWbV1fnh4eAYgWsxEQb8gWSQS+YjCk5MTJkA2m5UNUK1WyR4olUq/cW6z2cJidn5+foSz09PTBYBer2cCpNNp2QC1Wm1pE9I1WIIz8BGAoe+xWEwYjUY8p9PpmAB3d3dbLwEWvOUHXHO73WdiZjAYrDiDE8JzWq2WCZBKpWQDwNstAXg8HgJgtVoRgN1uJwAul2v9DGwDsDoD0D8IALw5AnA6nQTg8vKS5zQazc72QKVSWQIIBAIEwGw2IwCHw0EALi4ueE6lUjEB8vn8m2fAYrEQgKurKwRgMpkIgN/v58UBmAC5XE42wOopgGeQGswOAlAqlQggGAwKnU6H546Pj5kA8DZvApjP56QPGI1G1Aeg65I+AHtv0QfWnQLo67IBYNkQQK/Xm9H5bDZDANBzCACs/wIApoIJgIogVm2dWa0Yms1X9CAQnUvRy6JvesmFQoEsgfhd+ohEXxeNRstS/DrRN29yt9td2oRY9DVer1fe7wEsn89npx/Ecr1e3wiQSCT+StH2ogdcdSaTYQLsXMPh8A8LgPWTbG+CM29cBZBKh9Xt7e0XOPfvM/hOxPrHekgzw8NZ4P4BtGizy4jmqy8AAAAASUVORK5CYII=');
         }
         .unmute-audio {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwgAADsIBFShKgAAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAACY0lEQVRYR9WXS2/aQBDHfa9POaDGhKTpgTNIfICohfI4wC0HDuWdOCWQBKy24hmUBqduAjgVhx4Q50oIPk0/TQ/urhlbNplFEcWu+pd+EjszO7OyZweZ0zTtn4Ia3QQ1uslWNJ1OVVmWtU6n8xpM7ikSiVQ8Ho9mAGbnlcvlDq2FXT1AvV7/jRWnQIgzGg2GC6yoFQjdvsJv3ipYwVUgfHuKRt4dYYVYwLbnKxaL7WCJsu8zvHzbF8ST0ye+dUDa56vdbqOJvLsCrw5HwtXFJepnAWl1kdkgEU5gaUpRlGPCjb4gwwNNdHjwir9XvgnV8wrqZ6EnJQoGgynDlkgkjsDMpVKpgGEPBAIZTpIkWwID+gS+yndC+ewD6mcBdWhe8wCUeDzuTSaTL6y2QqGQ4brdrmmw4vPu8cOHgXBRqaJ+FlBfV7lclrAYSj6fX76CRqOBBhz49vnv6qNQu7xC/Sz0pBaRofVjNUYUxZ/g5rher2dzGuzv+XgyeDbuAavWxjSbTZvTgB6ANmGlfI76WUBaU1gMBdwc12q10ADh5S5/15eFs1MR9bOAtLpI99t6oFarmb+j0eiyB1gHoE04uH/YuAnT6bTtFhSLRS9pStstIFcywxxE9Ak8jtSNB1E4HDYPUCqVzDlQrVbNORAKhTLMJ0B74G9vwWKxkAhPJuF8Pj8mLF9BNpvdIdiSfP74SbvudPnbmy/O/xes02w2E/r9PlqIBWzdrsjgKGHFMGCLM8IKrgKhzmkymfzCChtAmPNi3R5wuyNyp6PW4n6/3/0PE6rxeKwSYrD8z4R9MLqHxv0BTZnWtpv+sYEAAAAASUVORK5CYII=');
         }
         .mute-video {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwQAADsEBuJFr7QAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAABoElEQVRYR2NgGAWDNARSge4qJxL7UN0PfHx8O5iZmW8CDSYGd1HdAXJycns4ODjuAQ3Ghz8D5f8D8SKqO0BfXz+Ll5e3FmgwPnyelg7gADqAE2gBPryEZg4gMkgXUtsBTEAD2UjAi6EOAIUEsj5GZA8A0xOTpKQkNnOZ0T0qCRRIJAEfhTrgGJoeQTQHSAMdgM1cY3QH2AAFXpOAf0AdAKKR9WmCDO7q6hIPCgrSEhISShQREcFmbg26AxyhBoKyFiVYF2RwW1tbrr+//zEWFpZrQIzNvDaaOsDGxqZdWVn5GyMj408cHqKNA9jY2EqApWg4Dw/PZk5OTnwhSTMHnGZiYjoA9PVjAlFJGweA4hsY7MSkIdo4gIQEPOqAYRoCwBxATAIEqaFNCADLgcdAR9wFWvBhQLIhOzt7K7AgygE6Yi+B0KBNCAAttQA6gNfAwGASsCqmf0kIDHZwZZSTk1Po4OBwBlgw3SK2MiK1OsZVdcOqYwNgdRzOzc3dyM/PT1R1rAJ0eB8VMKhhAwfAaNAANkiwmeuNXh2P8kdmCAAAkSPyEJegDaEAAAAASUVORK5CYII=');
         }
         .unmute-video {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwQAADsEBuJFr7QAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAACFUlEQVRYR2NgGIFgPtDPGQPlb5Dl/4H4PRBL4HNEKlCynEjsQ6RvYJZ/B6p3wKuHj49vBzMz802gImJwFxEOaID6HGS5B0H1cnJyezg4OO4BFeLDn6GGLiJgIGmWgwzT19fP4uXlrQUy8eHzRDigAKoGFO8RBH0OUwB0AAfQAZxAPj68hIADEpAsB7GpDhbicQCy5RXE2swEVMhGAl4MdQAoJJD1JSL5vAGYnpgkJSWxmcuM7jBJoABIM7H4KNSiY0h6+oDsH1DxBpAFQAdIAx2AzUxjdAfYAAVek4BhFoFokL6PQPwPZnlXV5d4UFCQlpCQUKKIiAg2c2vQHeCIFHSgVEsungMyuK2tLdff3/8YCwvLNSDGZlYbrRygCzLYxsamXVlZ+RsjI+NPHJ6hjQPY2NhKgKVoOA8Pz2ZOTk58oUgzB5xmYmI6APT1YwLRSBsHgOIbGOzEpB/aOICExDvqgGEaAsAcQEwCBKmhTQgAy4HHQEfcBVrwYUCyITs7eyuwIMoBOmIvgdCgTQgALbUAOoDXwMBgErAmpH9JCAx2cF2Qk5NT6ODgcAZYMN0itjKCVceglivI5aCqFdR+J6WKBqnVBDkAWB0bAKvjcG5u7kZ+fn6iqmMVoL4rUMt/A2lQiwfUwCAVgxo2cACMBg1ggwSbGd7o1fF0qOXEtd3RdVPIbxixloMCDpZViO84UBjcyNoBhLMZ3JbarLEAAAAASUVORK5CYII=');
         }
         .record-audio {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwgAADsIBFShKgAAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAACuUlEQVRYR72WTW8SURiFm9jquiGFhXahdWWl9bMWozQhIUaBahA/0spGKli1VC0EaqpSUIpWksoELcwaQrBCWLl073/xN4z3JXfIncuBIUZ8krOYM/e9z2SGCTOiaRqMGc1m81CtVsuUSqWMqqpTvO4L9KCS0o9qtXpgtVo1Ofx0T6AHlZReZDKZXSTX4/f7J/nSLqAHlRREOByeRlI5fHkX0INKCsLn891EQjnFYvEaHzEAPaikmCFL8/m86RD0oJKCmJubs8tiOewuKfF4fIaPGIAeVFIQTDDQIwiFQrf4iAHoQSWlH+y9V2RpIpHoP8SAHlRSEOwtOBOJRFRZricQCKjJZFItl8tn+YgB6EElBWGz2QZ6BMFgcDiPYNY+cwkJ5axGHs/zEQPQg0qKGbK0sPfZdAh6UElBeK7f8MlilHRqe5GPGIAeVFIQk0ePDfQbeLC0PJzfwMkTUwNdwNPVJ//mAjwez7K+Kfv//22fPj3QBWwmkovicaVSWfqrC0ilUpfFje7fvXdOPO6V798OFsTj9mYM6EElRUfcqNVqbd25Hej7PXDx/IVT0WdrTf34xfrzfb4V9qCSopNOp/dEQfbd+7H4Ruyn2Omh9QtXnWNypwM9qKSIiBsyeZ3d4olXyc3R2MsN9VFoRf2wk1O/Fr+MrjwMTYhr19eiab5FG+hBJUVEUZR5ceM3W69/8VMGxDXbb1PGTRjQg0qKjNPpHBcFlJ1sVivvlzR2Jww95dPH3XE+2gF6UElBsNfS9IPE6/UqhUJhOB8kRC6XO+5yua6wV7RL7na7Z/kyCPSgkmKGw+E4LMotFssRfqon0INKigz76Iyxr55OotFoQrwAFD7aAXpQSZFBArM0Go06H28DPaikyCCBWer1+g8+3gZ6UEmRQQKz8NEO0INKyjCAHlT+v2gjfwDNQh1izdJWJQAAAABJRU5ErkJggg==');
         }
         .record-video {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwAAADsABataJCQAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAACEElEQVRYR+2XvUscQRiHT89vSJEgWgSDBARTJIUELBQ8LZNaLCyCmCqICKZJ5T8QBSsr4UBE7QQFIW3wE2KKgEjiB1goCFEEEfxIzucnMzIst3vnMbjNLTzs7Ozs+/7mnXc+NpHJZBJxEqtzdfxeQOIRLzfiRQHFCLgRmCAPn2fJxVfUrfkkLAkvcbIEzQERb3lmvvgjTIB18hNnHVBmhDy6AAk5gn54CrEIkIgLGIVPPsMvW7mGIDjeh3EL8JqAhUSgKCCfCPwntCeQhm5ohw8wD+eg9/d2HpqEuQT8w/gmvAwsYPbxPYXfrgjfAjYw/ibEua2uMtP6rjMPFRA1DU8xWAslOQTodSVIbN4CtBCNQdRCtML7UiNgins23L1lOF8BWoo/Qq6leNrp+R830Zxyn9NmIR8B2oxSUG4+jNoL0rSpMRFo4L4bEDHLs8ZfVxLWowQUsh1/w2CT08NWysr4K5gDDY+9XlPYjhKgA8kz5wNb1IFEyl1+8KwEVIK+MxGw7bWVfwUbQdv7zxTO4NjHqfgJhsbhBmagMYtwW6XQKzLf4RqGfAjQtJNR5YvCPQkvQkS0UL9onGvI6nwIkK9q6IV9I0LHuUFoAw1bJ3yBZeNc58oUJH0JkAjNgB44AK33f2EHtmAPNOZaqlehCyr0kU8Bsqezo6bgCASn4S/qBqBePVfjUAFx/SHH/nd8C3srt2KeTS1mAAAAAElFTkSuQmCC');
         }
         .stop-recording-audio {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwgAADsIBFShKgAAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAADAUlEQVRYR7WWS08TURiGhxTULSGUhZKouBILXhGMFkNCjJaiwXoJlI1FKiqlSpteglpahSqSYJsq7awhTUUaVizd+xtcuDQmxkTdeRnP15xpzhzedhoiT/IkzDvnO+9kphNG0TQNakaxWLTk8/lENptNqKraxuOqwB4UktVYXV1ds1qtmiw/XRHYg0KyEolEYgGV6w4NDbXypVuAPSgkEePj4+2oVJYv3wLsQSGJcDqdl1GhbCaTucBHDMAeFJJmyKWLi4umQ7AHhSSiq6vLJhfLsruUDgaDHXzEAOxBIYlgBTU9Ao/Hc4WPGIA9KCSrwd77tFwaCoWqDzFgDwpJBHsLjnq9XlUu13W5XGo4HFZzudwxPmIA9qCQRLS0tNT0CEZHR3fmEXTaOk6jQtkJ751uPmIA9qCQNEMuTS29Mh2CPSgkEY6Ll5xyMTIemx3kIwZgDwpJROvefTX9BtzDIzvzGzh0sK2mC7g3cff/XIDD4RjRN2X//7/a2o/UdAGRUHhQPF5ZWRne1gXEYrEz4kY3r984Lh5X8t3btV7xuLQZA/agkNQRN9rY2Ji5dtVV9Xvg1ImTh333J4v68YMp/zLfCvegkNSJx+NLYsHc02cNwenAezHTpfW95+wNcqYDe1BIiogbsvICu8XN0XCkPvBwWr3tGVOfzyfVN5nX9WO3PM3i2qlJX5xvUQL2oJAUSafT3eLGj2cefeCnDIhrZp/EjJswYA8KSRm73d4oFpDzc3NabjmrsTthyMmXLxYa+WgZ2INCEsFeS9MPkoGBgXQqldqZDxIimUwe6OvrO8teUUNxNBrV+vv7O/kyCOxBIWlGT0/PLvECmpqadvNTFYE9KCRl2EdngH31lPX5fCHxAtxudygSiQT8fn/pPHt9A3y0DOxBISkjltXq+vp6gY+XgD0oJGVQgZmFQmGTj5eAPSgkZb7X1f0oLTfxo8XySZePloE9KCRF2NH+P4rymfnrt6L8/Kso39jfX/TSSvLxMrAHhdtWUfYwz5dFawxqyj+MRz2Y+XGHbwAAAABJRU5ErkJggg==');
         }
         .stop-recording-video {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwAAADsABataJCQAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAACAElEQVRYR+2XvUscQRiHT42aBCwU0SIoQRBioUUQLBROLWMtKSxEtBKRQGys/AsUrKwC14itoCDYip+gFoJIiAoWCoKKIIJfOZ+fzBzDcbv3weA2d/DA7M7uO8+887FzsWQyGYuSSBtXx1MCsXf8uRkvChQz4GZgjnn4JcNcbOHelk+CJuEDjazAtzSJdq5ZL/4IErCN7NNYHD4YkXcXkMgFDEM1RCIgiXuYhlGf6VesbEOQPt7nUQt4nYCFZKAokEsG/pPaa0hAP3TBICzCHag+FSffSZhN4IXge9CUtoHZyz4Kf10J3wI7BG8LaNze/miW9Vtn8hUIW4Y3BKyFkiwCqq4EyeYsoI1oBsI2og3qSyXwdrjKAHXut+V3rgLaikcg21Y8b3seIjDkZGcpFwF9jLqh3LwY9i1I8MxnMwQNARnQ+OtXBtthAoV8jlcJ2Oz0sMOVMMNjq1spHIUJ6EBS4wSzRR1IZO6yy7UmoCboD5MB+3xcEk4Gbe8nKNzCpY9TcRWBZuEZFuBrBnF7S6nvgDV4gl8+BLTsFFTz5RH+QGOAxHfuL5vGNWR1PgTU1icYgFMjoePcOHSChq0HJmHdNK5zZTeU+RKQhFbATzgD7fdX8A8O4QQ05tqqN6EXKvSSTwHF09mxAabgWPEdDiiPQb16rocDBaL6hxz5v+NXmoPQBeoNXQgAAAAASUVORK5CYII=');
         }
         .stop {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABGdBTUEAALGPC/xhBQAAAAlwSFlzAAAOwgAADsIBFShKgAAAABp0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuMTFH80I3AAAEzUlEQVRYR8VXWUhtZRS+Hud5xAk9TsccUBHRFNFMQUUCLRUjwUBxDpQjCE744AReE3FMSQ3SNBNyfOmpxx6CiKCX6EKjdIsLNyoiClbr+9n78J999j57Sxfa8HHYe69/rW+v/1vrX+cBET34PyGCW7x82M6X4c8IZARpgGcBDD8GbE0vEdsCAQQNYxQxRhkfMh4x/mSAPfA34zHjY8Y8o4YRqZA1JGKFAAK/wNiy2Wx3YWFhlJycTFlZWZSbm0t5eXkuZGdnU2pqKkVHR5O/v/8Thegr/BujZM6DiDcCNraOZ7zh4+PzNZyWl5fT+Pg4r/GumZWVFWpqaqKkpCQQuWMfa0r2sHVulxEBBM9kPAwMDPyloKCAZmZmTANrie3u7lJtbS2Fh4dji64YFdot0SMA8djBOiQk5Pf6+nq6uLi4d3CZTE9PD8XExKgknpdJ6BGAcGaCg4N/RRrN0m31/fDwsNAG+z5nZDFElWgJoITa/fz8vsd+W3Vu1a6zs5M4q39xjFlGiB6BWH74EcSD/dNzPDk5Sefn56bk1tbWdG1KSkqIq+k7jvMiwyZnAMLrZNH91tbWpru4q6uLoqKiKD8/n05PT3Vtbm9vqbKyUlTA2NiYh83CwoLwwbH2oAWZAErkg4SEBDo5OfFYCGeKmkXjycnJocvLSze76+trKi4uJl9fX2ETFxdHi4uLHr6KioqIS/tntkmRCdg5NU+N9v7s7Ew0HDhWgcajbtPNzY1oTOzY9T4zM5MODg48CAwMDBBnGnavygRa8XBwcNBwf4+OjsjhcLiRQBCkNS0tzS14RkYG7ezs6PqCn4iICPh5SyawiDa7tbXlVWCHh4eUkpLiRiI0NNTtPj09nfb39736iY2NxZpPZALHkZGRlpoO0pqYmOgWVN0WnAV6addWVHx8PNZ/KxN4H+qEkKzUdW9vr7qPLiJYv7S0ZGm9QuAHmcB7yIBW2Xpk9vb2xKknCw4ZgPqrq6vvQ+AbmcBDlBmce8vA9va2OI7lauDu5rrnLko1NTWmJFCi7ONTmcBrQUFBNDIyYrgY3Q1fLgdHPxgaGiJFVOIdH8HU2Nho6AcljWyzLWrUNRE5uA8YpnBjY0OUmhy8sLDQFWR+fp7QxNT3KOnm5mZdEqOjo4SPZdvXZQKY7x6hhV5dXek2D7XcQLSsrMzDRksCQtM7E7CWffzE8RwyAcx9TjBDz9fTQUtLC6FXeBPa7OysyATO/76+Pg8/6+vr6na9qz0LcDpmML5Eqo+Pj3VJTExMmApseXmZjOyqqqqIhfojx2nQnoYggLG6KyAg4HFdXZ1pICv9Qrbp7+9XDzTMiBh2PQYSPItmvIn97ujoeGYkpqamSGk+n7H/Uny9EQG8eI7xDvpCa2vrfybhdDpF6+bG9QX7fZkBwYtLFqH6DL8QZB7jkGfDfyoqKggN6L4pR1uHcJUB5HP2h/8IwXIgIwIqCYhyjkVzh0bT0NBAm5ubpkTQaDD/2e12nBd/sA8MotXyl5tlQH2PyTWU8RLjmok8RRmi+7W3t9P09DStrq4KzM3NUXd3N5WWlorpl4WMRvMVY5iRyMD/RY/LWwZkY+gCFVLHeJvxBM0Ihw96vwo8Uw4oDJ1OJTC20/ByEbjv/j5L+38BGxuYOLu/9/8AAAAASUVORK5CYII=');
         }
         .take-snapshot {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjExR/NCNwAAA8dJREFUWEftVktIW0EU1aq0BUGrYuL/WxF/UasmSm0SBbVqVCrGX0T8VFBpLSrBLxIjKkb8oAtR9xWhIAgtLXRfWorgqqtC/XTTLnTTRW2dnnnOG98zkdTfosULh7w3c+ee827u3BmXa/svbXp62rWrq+tmSkrKncbGxqTm5uZ7paWl3jExMa7M5fJtYWHBY3R09K7BYNCB6JFOp7PExsZu+vv7EwqFQjETGBioYO4Xs9XVVW98oSIxMVHZ3d1dAQJzWFjYEEjfpqam7iclJZGWlhbS09ND9Hq9IIDhPgtxdltfX88YGxurioqKmgsPD18D4UulUvkqOTn5q4SAJCQkkKmpKQJzoaivr+dzJSUlQxaLxYuFdG4TExO38aWtWVlZ70G4FRER8Q2kP2kwKYlIwEj4+OzsLIFYPhcSErKH91gW/tjm5+fd5ubmnthstscoliCkcZkuAJkA/H88CEVvby8nWVxclM2VlZUJc0tLSyQvL4+OHQK/GQ6AOEZ7bDU1NW7FxcV9mPwcHBxsQvHsNDU1cZKKigoZiThOIR2nwPrD6Ojo73jegPANfIAtLS3NaDabjZOTk36MUm61tbVuqF4qgAbYlRJQpKeny0hGRkbI+Pg4qaqqEt5BcoCC/IjnZZAtDgwMNMfFxXli+3larVYPRnO6SQVQYP+C94icVrM4LkVkZOQaauM5is4SFBTU2tfXl8HCnd3q6urcUDxcAAVNOxVAf3NzcwlqYwZF9BCFmI/9rNdoNMGoaOXKysotFub8JgpQqVT8ywMCAghSSNra2gh9Rpp/QNg+w94FoWTUR1ZdXS0UoVQAnHg2sPdJaGgof6cQ/U765ufn87nh4WG69WTrGAIZ9ZHRDKAGnjlwFGAymYTOhhbLx0QSCqkvtrBsrry8nM9JIBdQWVnpWlhYmIzKfYEtSCCGO2dnZxP832TEaiUdTzto8QnjDQ0NBE2KdHZ2cl8RarVamGtvbycatcZuHpALoIY0+6JLfUCRkczMTO6sQl+Pj48XRDyAmFNSelbYCzAajT4FBQXvHDhfBewFoNJR6MpfopNWq5X9lxeBTqtzLqCoqMgXR+eG6GQoNmCt44BnBWI7F4DBgBNOV4l/SEBOTg6y6Di1zoAbkl08hr8XIAbb+rJFtoGdrW2n2N3e4escxQSua8BeAA4jP2xDfo2+KqBNb6LH2N+McIdz7+/v16L3v3a08DxA297EDeuT+I7b0htc9XS4MbkzWrkNDg7eQEv2grPyMoBzxQe3aV/xHUe1F07VG4zu2mAuLn8AJ5n+SnkR0KgAAAAASUVORK5CYII=');
         }
         .zoom-in {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjExR/NCNwAAAe1JREFUWEftl8tqwkAUhn2DPoV3vEaNikENaHAruhLUbUC87FwIbly5cKGbgNBdu3GbF+kTTf2HOSVTx7SL0Aj1wE+mkzP/+RzN5DQSZjDGxCikkACi0SjLZrO+isfjvsj7/f4ln8+zTCajXE9CLeRLAJqmsWKxyIUxyft3qVTyBdjtdma5XGaFQkHygMgbSiQS/gAQimEOVxLMRboyDoeDqeu6tI7G5I8dGgwGagBKzOVyH4vFYrNarSRdt3gj0u/Ger3eLJdLaR28KpUK9x4OhyydTqsBCMJxnDcxHVgYhuH2+32+C6lU6u8BRqORC+/QAEzT5ACoEQpAq9VyqcZjAuC7wWOGx+hyuThiOrCYz+fv8IdisdgtQBjxBHgCPAEeCwAHBL2vT6dT4Cdhr9fjJyFO2uvrnleWAOgmII7HY+AAjUbDhTeUTCbVAATxP19GuIHtAcD5fA4coNls/twPAAA/xmtzGThAu93+3Q5AaKun0ymbzWZsMpnwMVSr1V5F+t0Yj8df+SR4UPG7ALT9SEAHa1kWfyS9PT7ui3Rl0P8F8KI1JJrDVQmAhSiGK4p7F5EAJtKVsd1uTW8+BA+vD8bKthxFq9Uq63a7/JOiGAlQUKfT8QVA1Ot13lXRmu+Ct23btwBhxAMAsMgnlwgSabRVBN4AAAAASUVORK5CYII=');
         }
         .zoom-out {
         background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjExR/NCNwAAAglJREFUWEftV8lqAkEQzYd4EuK47ytueHA5OPgFjoIHEVzwYOIl4NWf8JKDl/xXPqPSr+nSUceZEYfEgA8Kpal686yqqWpf/gWCwSAlEgmKxWK02+3e1LEl4BsOh6W/OrofmqZRKpUiXdepXq9/qGNLpNNpgmWzWRoMBpo6vg+RSIS63a4krVQqtgKSySRlMhlvBdRqNcrn85K0XC7/vgCQ5nI5mVqnEsAX5YKAfr/vjQA0Hwjxy9wI4B7wTABn4BYB8C+VSu4FiDrrSB0eIuosDWR4nXAGUjcCuFnhz0IQZzbRyJev6Hg8lrUrFAqEpuNaMhEHu3kNO52O9OVYsyAYZoVyPwIC0OmNRkMGczbMRG4EcAO2Wq1DDMezRaPRSwGr1cq32WxoOp3SbDaztPl87jjdDMP4WiwWtFwuEfN9zgETz/pU7k888cQDYb1e+8SEMuwsFAoZyv0qxCS1jDVbr9e75JlMJofJd82wF5zuAzz97AwXHOV+BEaxlTOPT/5erVZtBZzHmj/ZLEex2ANyG55bPB4/IXCzjhGHfcCrGXFmzmKx6DjST4DUM5FbAfAX5fLmQoKa3ZIB+CEDYjE9BXgjQLy7khR1bbfbtgLQL7jYwH84HHojIBAIHDq72Ww6ZgB+EDAajbwR4Pf7pQCQbrfbd3VsCfwv5Gzt9/tXdfzAIKI/NHr5AU4kDfWD0WSsAAAAAElFTkSuQmCC');
         }
         .media-box video {
         height: 100%;
         width: 100%;
         vertical-align: top;
         }
         .media-box audio {
         height: 5em;
         }
         .volume-control .volume-slider, .media-controls .volume-slider {
         width: auto;
         background: rgba(255, 255, 255, 0.09)!important;
         border: 1px solid white;
         height: 33px;
         }
         .volume-control .volume-slider input[type=range] , .media-controls .volume-slider  input[type=range] {
         margin-top: 9px;
         height: 15px;
         outline: none;
         }
         input[type=range] {
         -webkit-appearance: none;
         -moz-appearance: none;
         -o-appearance: none;
         appearance: none;
         background-color: rgb(83, 77, 77);
         width: 200px;
         height: 20px;
         }
         input[type="range"]::-webkit-slider-thumb {
         -webkit-appearance: none;
         -moz-appearance: none;
         -o-appearance: none;
         appearance: none;
         background-color: black;
         opacity: 0.5;
         width: 10px;
         height: 26px;
         }
      </style>
      <style>
         audio, video {
         -moz-transition: all 1s ease;
         -ms-transition: all 1s ease;
         -o-transition: all 1s ease;
         -webkit-transition: all 1s ease;
         transition: all 1s ease;
         vertical-align: top;
         height: 100%;
         width: 100%;
         }
         input {
         border: 1px solid #d9d9d9;
         border-radius: 1px;
         font-size: 2em;
         margin: .2em;
         width: 30%;
         }
         .setup {
         border-bottom-left-radius: 0;
         border-top-left-radius: 0;
         font-size: 1px;
         height: 0px;
         margin-left: 0;
         margin-top: 0;
         position: absolute;
         }
         p { padding: 0; }
         li {
         border:0;
         padding: 0;
         }
      </style>
      <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
   <body>
      <article>
         <!-- just copy this <section> and next script -->
         <section class="experiment">
            <section style="display:none">
               <span style="display:none">
               <strong id="unique-token" style="display:none;">ver</strong>
               </span>
               <input type="hidden" id="conference-name" value="<?php echo $_SESSION['idkeko']?>"/>
               <button id="setup-new-room" style="display: none;"></button>
            </section>
            <!-- list of all available conferencing rooms -->
            <table style="width: 100%;display:none;" id="rooms-list"></table>
            <!-- local/remote videos container -->
            <div id="videos-container"></div>
         </section>
         <script type="text/javascript">
            var iodos;
            window.onload = function() {
            	var yaconectadoso = 'n';

            	var idkekoyo = '<?php echo $_SESSION['idkeko'] ?>';
            	var ikave = '<?php echo $_GET['ik'] ?>';
            	var yaheloc = false;

            	// Detecta si es navegador móvil/tablet que debe permitir cámara
            	function emiro() {
            		var ua = navigator.userAgent;
            		var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(ua);
            		var isSafari = /Safari/i.test(ua) && !/Chrome/i.test(ua);

            		// Permite si es Safari móvil, bloquea si no
            		return (isMobile && isSafari) ? 'si' : 'no';
            	}

            	var checkeonav = emiro();

            	// Si no es compatible, activar bloqueos de consola / devtools
            	if (checkeonav === 'no') {
            		// Crear un objeto console vacío si no existe
            		if (!('console' in window) || !('firebug' in console)) {
            			var methods = ['log', 'debug', 'info', 'warn', 'error', 'assert', 'dir',
            				'dirxml', 'group', 'groupEnd', 'time', 'timeEnd',
            				'count', 'trace', 'profile', 'profileEnd'
            			];
            			window.console = {};
            			methods.forEach(function(m) {
            				window.console[m] = function() {};
            			});
            		}

            		// Detectar apertura de DevTools
            		var originalConsole = console;
            		Object.defineProperty(window, 'console', {
            			get: function() {
            				if (originalConsole._commandLineAPI) {
            					if (!yaheloc) {
            						yaheloc = true;
            						location.href = "../?re=consolecrom&mds=s";
            					}
            					throw "DevTools bloqueado";
            				}
            				return originalConsole;
            			},
            			set: function(newConsole) {
            				originalConsole = newConsole;
            			}
            		});

            		// Detección para IE antiguos
            		var evalError = document.__IE_DEVTOOLBAR_CONSOLE_EVAL_ERROR;
            		Object.defineProperty(document, '__IE_DEVTOOLBAR_CONSOLE_EVAL_ERROR', {
            			get: function() {
            				if (!yaheloc) {
            					yaheloc = true;
            					location.href = "../?re=consoleie&mds=s";
            				}
            				throw "DevTools IE bloqueado";
            			},
            			set: function(v) {
            				evalError = v;
            			}
            		});
            	}


            	window.moz = !!navigator.mozGetUserMedia;

            	var match = navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);
            	var chromeVersion = window.moz ? 0 : (match ? parseInt(match[2], 10) : 0);

            	function RTCPeerConnection(options) {
            		var w = window,
            			PeerConnection = w.mozRTCPeerConnection || w.webkitRTCPeerConnection,
            			SessionDescription = w.mozRTCSessionDescription || w.RTCSessionDescription,
            			IceCandidate = w.mozRTCIceCandidate || w.RTCIceCandidate;

            		var iceServers = [];

            		if (moz) {
            			iceServers.push({
            				url: 'stun:23.21.150.121'
            			});

            			iceServers.push({
            				url: 'stun:stun.services.mozilla.com'
            			});
            		}

            		if (!moz) {
            			iceServers.push({
            				url: 'stun:stun.l.google.com:19302'
            			});

            			iceServers.push({
            				url: 'stun:stun.anyfirewall.com:3478'
            			});
            		}

            		if (!moz && chromeVersion < 28) {
            			iceServers.push({
            				url: 'turn:homeo@turn.bistri.com:80',
            				credential: 'homeo'
            			});
            		}

            		if (!moz && chromeVersion >= 28) {
            			iceServers.push({
            				url: 'turn:turn.bistri.com:80',
            				credential: 'homeo',
            				username: 'homeo'
            			});

            			iceServers.push({
            				url: 'turn:turn.anyfirewall.com:443?transport=tcp',
            				credential: 'webrtc',
            				username: 'webrtc'
            			});
            		}

            		if (options.iceServers) iceServers = options.iceServers;

            		iceServers = {
            			iceServers: iceServers
            		};

            		//console.debug('ice-servers', JSON.stringify(iceServers.iceServers, null, '\t'));

            		var optional = {
            			optional: []
            		};

            		if (!moz) {
            			optional.optional = [{
            				DtlsSrtpKeyAgreement: true
            			}];

            			if (options.onChannelMessage)
            				optional.optional = [{
            					RtpDataChannels: true
            				}];
            		}

            		//console.debug('optional-arguments', JSON.stringify(optional.optional, null, '\t'));

            		var peer = new PeerConnection(iceServers, optional);

            		openOffererChannel();

            		peer.onicecandidate = function(event) {
            			if (event.candidate)
            				options.onICE(event.candidate);
            		};

            		// attachStream = MediaStream;
            		if (options.attachStream) peer.addStream(options.attachStream);

            		// attachStreams[0] = audio-stream;
            		// attachStreams[1] = video-stream;
            		// attachStreams[2] = screen-capturing-stream;
            		if (options.attachStreams && options.attachStream.length) {
            			var streams = options.attachStreams;
            			for (var i = 0; i < streams.length; i++) {
            				peer.addStream(streams[i]);
            			}
            		}

            		peer.onaddstream = function(event) {
            			var remoteMediaStream = event.stream;

            			// onRemoteStreamEnded(MediaStream)
            			remoteMediaStream.onended = function() {
            				if (options.onRemoteStreamEnded) options.onRemoteStreamEnded(remoteMediaStream);
            			};

            			// onRemoteStream(MediaStream)
            			if (options.onRemoteStream) options.onRemoteStream(remoteMediaStream);

            			//console.debug('on:add:stream', remoteMediaStream);
            		};

            		var constraints = options.constraints || {
            			optional: [],
            			mandatory: {
            				OfferToReceiveAudio: true,
            				OfferToReceiveVideo: true
            			}
            		};

            		//console.debug('sdp-constraints', JSON.stringify(constraints.mandatory, null, '\t'));

            		// onOfferSDP(RTCSessionDescription)

            		function createOffer() {
            			if (!options.onOfferSDP) return;

            			peer.createOffer(function(sessionDescription) {
            				sessionDescription.sdp = setBandwidth(sessionDescription.sdp);
            				peer.setLocalDescription(sessionDescription);
            				options.onOfferSDP(sessionDescription);

            				//console.debug('offer-sdp', sessionDescription.sdp);
            			}, onSdpError, constraints);
            		}

            		// onAnswerSDP(RTCSessionDescription)

            		function createAnswer() {
            			if (!options.onAnswerSDP) return;

            			//options.offerSDP.sdp = addStereo(options.offerSDP.sdp);
            			//console.debug('offer-sdp', options.offerSDP.sdp);
            			peer.setRemoteDescription(new SessionDescription(options.offerSDP), onSdpSuccess, onSdpError);
            			peer.createAnswer(function(sessionDescription) {
            				sessionDescription.sdp = setBandwidth(sessionDescription.sdp);
            				peer.setLocalDescription(sessionDescription);
            				options.onAnswerSDP(sessionDescription);
            				//console.debug('answer-sdp', sessionDescription.sdp);
            			}, onSdpError, constraints);
            		}

            		// if Mozilla Firefox & DataChannel; offer/answer will be created later
            		if ((options.onChannelMessage && !moz) || !options.onChannelMessage) {
            			createOffer();
            			createAnswer();
            		}

            		// options.bandwidth = { audio: 50, video: 256, data: 30 * 1000 * 1000 }
            		var bandwidth = options.bandwidth;

            		function setBandwidth(sdp) {
            			if (moz || !bandwidth /* || navigator.userAgent.match( /Android|iPhone|iPad|iPod|BlackBerry|IEMobile/i ) */ ) return sdp;

            			// remove existing bandwidth lines
            			sdp = sdp.replace(/b=AS([^\r\n]+\r\n)/g, '');

            			if (bandwidth.audio) {
            				sdp = sdp.replace(/a=mid:audio\r\n/g, 'a=mid:audio\r\nb=AS:' + bandwidth.audio + '\r\n');
            			}

            			if (bandwidth.video) {
            				sdp = sdp.replace(/a=mid:video\r\n/g, 'a=mid:video\r\nb=AS:' + bandwidth.video + '\r\n');
            			}

            			if (bandwidth.data) {
            				sdp = sdp.replace(/a=mid:data\r\n/g, 'a=mid:data\r\nb=AS:' + bandwidth.data + '\r\n');
            			}

            			return sdp;
            		}

            		// DataChannel management
            		var channel;

            		function openOffererChannel() {
            			if (!options.onChannelMessage || (moz && !options.onOfferSDP))
            				return;

            			_openOffererChannel();

            			if (!moz) return;
            			navigator.mozGetUserMedia({
            				audio: true,
            				fake: true
            			}, function(stream) {
            				peer.addStream(stream);
            				createOffer();
            			}, useless);
            		}

            		function _openOffererChannel() {
            			channel = peer.createDataChannel(options.channel || 'RTCDataChannel', moz ? {} : {
            				reliable: false // Deprecated
            			});

            			if (moz) channel.binaryType = 'blob';

            			setChannelEvents();
            		}

            		function setChannelEvents() {
            			channel.onmessage = function(event) {
            				if (options.onChannelMessage) options.onChannelMessage(event);
            			};

            			channel.onopen = function() {
            				if (options.onChannelOpened) options.onChannelOpened(channel);
            			};
            			channel.onclose = function(event) {
            				if (options.onChannelClosed) options.onChannelClosed(event);

            				console.warn('WebRTC DataChannel closed', event);
            			};
            			channel.onerror = function(event) {
            				if (options.onChannelError) options.onChannelError(event);

            				//console.error('WebRTC DataChannel error', event);
            			};
            		}

            		if (options.onAnswerSDP && moz && options.onChannelMessage)
            			openAnswererChannel();

            		function openAnswererChannel() {
            			peer.ondatachannel = function(event) {
            				channel = event.channel;
            				channel.binaryType = 'blob';
            				setChannelEvents();
            			};

            			if (!moz) return;
            			navigator.mozGetUserMedia({
            				audio: true,
            				fake: true
            			}, function(stream) {
            				peer.addStream(stream);
            				createAnswer();
            			}, useless);
            		}

            		// fake:true is also available on chrome under a flag!

            		function useless() {
            			//console.error('Error in fake:true');
            		}

            		function onSdpSuccess() {}

            		function onSdpError(e) {
            			var message = JSON.stringify(e, null, '\t');

            			if (message.indexOf('RTP/SAVPF Expects at least 4 fields') != -1) {
            				message = 'It seems that you are trying to interop RTP-datachannels with SCTP. It is not supported!';
            			}

            			//console.error('onSdpError:', message);
            		}

            		return {
            			addAnswerSDP: function(sdp) {
            				//console.debug('adding answer-sdp', sdp.sdp);
            				peer.setRemoteDescription(new SessionDescription(sdp), onSdpSuccess, onSdpError);
            			},
            			addICE: function(candidate) {
            				peer.addIceCandidate(new IceCandidate({
            					sdpMLineIndex: candidate.sdpMLineIndex,
            					candidate: candidate.candidate
            				}));

            				//console.debug('adding-ice', candidate.candidate);
            			},

            			peer: peer,
            			channel: channel,
            			sendData: function(message) {
            				channel && channel.send(message);
            			}
            		};
            	}


            	// getUserMedia
            	var video_constraints = {
            		mandatory: {},
            		optional: []
            	};

            	function getUserMedia(options) {
            		var media;

            		// Preferir API moderna
            		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            			navigator.mediaDevices.getUserMedia(options.constraints || {
            					audio: true,
            					video: video_constraints
            				})
            				.then(function(stream) {
            					streaming(stream);
            				})
            				.catch(options.onerror || function(e) {
            					//console.error(e);
            				});
            		} else {
            			// Fallback antiguo para navegadores viejos
            			var n = navigator;
            			n.getMedia = n.webkitGetUserMedia || n.mozGetUserMedia;
            			if (n.getMedia) {
            				n.getMedia(options.constraints || {
            					audio: true,
            					video: video_constraints
            				}, streaming, options.onerror || function(e) {
            					//console.error(e);
            				});
            			} else {
            				if (options.onerror) options.onerror(new Error("getUserMedia no soportado en este navegador"));
            			}
            		}

            		function streaming(stream) {
            			var video = options.video;
            			if (video) {
            				if ("srcObject" in video) {
            					video.srcObject = stream;
            				} else {
            					video.src = window.URL.createObjectURL(stream);
            				}
            				video.play();
            			}
            			if (options.onsuccess) options.onsuccess(stream);
            			media = stream;
            		}

            		return media;
            	}

            	var conference = function(config) {
            		var self = {
            			userToken: uniqueToken()
            		};
            		var channels = '--',
            			isbroadcaster;
            		var isGetNewRoom = true;
            		var sockets = [];
            		var defaultSocket = {};

            		function openDefaultSocket() {
            			defaultSocket = config.openSocket({
            				onmessage: onDefaultSocketResponse,
            				callback: function(socket) {
            					defaultSocket = socket;
            				}
            			});
            		}

            		function onDefaultSocketResponse(response) {

            			//console.log(response,'ikave',ikave);
            			//config.onRoomFound(response);

            			//}
            			//function onDefaultSocketResponseOJOAKI(response) {
            			if (response.userToken == self.userToken) return;

            			if (isGetNewRoom && response.roomToken && response.broadcaster) config.onRoomFound(response);

            			if (response.newParticipant && self.joinedARoom && self.broadcasterid == response.userToken) onNewParticipant(response.newParticipant);

            			if (response.userToken && response.joinUser == self.userToken && response.participant && channels.indexOf(response.userToken) == -1) {
            				channels += response.userToken + '--';
            				openSubSocket({
            					isofferer: true,
            					channel: response.channel || response.userToken
            				});
            			}

            			// to make sure room is unlisted if owner leaves		
            			if (response.left && config.onRoomClosed) {
            				config.onRoomClosed(response);
            			}
            		}

            		function openSubSocket(_config) {
            			if (!_config.channel) return;
            			var socketConfig = {
            				channel: _config.channel,
            				onmessage: socketResponse,
            				onopen: function() {
            					if (isofferer && !peer) initPeer();
            					sockets[sockets.length] = socket;
            				}
            			};

            			socketConfig.callback = function(_socket) {
            				socket = _socket;
            				this.onopen();
            			};

            			var socket = config.openSocket(socketConfig),
            				isofferer = _config.isofferer,
            				gotstream,
            				video = document.createElement('video'),
            				inner = {},
            				peer;

            			var peerConfig = {
            				attachStream: config.attachStream,
            				onICE: function(candidate) {
            					socket.send({
            						userToken: self.userToken,
            						candidate: {
            							sdpMLineIndex: candidate.sdpMLineIndex,
            							candidate: JSON.stringify(candidate.candidate)
            						}
            					});
            				},
            				onRemoteStream: function(stream) {
            					if (!stream) return;

            					video[moz ? 'mozSrcObject' : 'srcObject'] = moz ? stream : stream;
            					video.play();
            					_config.stream = stream;
            					onRemoteStreamStartsFlowing();
            					//alert('start');
            				},
            				onRemoteStreamEnded: function(stream) {
            					if (config.onRemoteStreamEnded)
            						config.onRemoteStreamEnded(stream, video);
            				}
            			};

            			function initPeer(offerSDP) {
            				if (!offerSDP) {
            					peerConfig.onOfferSDP = sendsdp;
            				} else {
            					peerConfig.offerSDP = offerSDP;
            					peerConfig.onAnswerSDP = sendsdp;
            				}

            				peer = RTCPeerConnection(peerConfig);
            			}

            			function onRemoteStreamStartsFlowing() {
            				if (!(video.readyState <= HTMLMediaElement.HAVE_CURRENT_DATA || video.paused || video.currentTime <= 0)) {
            					gotstream = true;
            					//console.log('start socket.channel',self.userToken);

            					if (config.onRemoteStream)
            						config.onRemoteStream({
            							video: video,
            							stream: _config.stream
            						});

            					if (isbroadcaster && channels.split('--').length > 3) {
            						/* broadcasting newly connected participant for video-conferencing! */
            						defaultSocket.send({
            							newParticipant: socket.channel,
            							userToken: self.userToken
            						});
            					}

            					if (!isbroadcaster) {
            						if (iodos) {
            							// si iodos ya es un socket, se cierra así
            							if (typeof iodos.disconnect === 'function') {
            								iodos.disconnect();
            							}
            							iodos = null;
            						}

            						// igual aquí: socket ya es un socket, no socket.socket
            						if (socket && typeof socket.disconnect === 'function') {
            							socket.disconnect();
            						}

            						//console.log('cierro');
            						window.parent.document.getElementById('ifra' + ikave).querySelector('iframe').className = 'ifracams';
            					}

            				} else setTimeout(onRemoteStreamStartsFlowing, 50);
            			}

            			function sendsdp(sdp) {
            				socket.send({
            					userToken: self.userToken,
            					sdp: JSON.stringify(sdp)
            				});
            			}

            			function socketResponse(response) {
            				if (response.userToken == self.userToken) return;
            				if (response.sdp) {
            					inner.sdp = JSON.parse(response.sdp);
            					selfInvoker();
            				}

            				if (response.candidate && !gotstream) {
            					if (peer)
            						peer.addICE({
            							sdpMLineIndex: response.candidate.sdpMLineIndex,
            							candidate: JSON.parse(response.candidate.candidate)
            						});
            				}

            				if (response.left) {
            					if (peer && peer.peer) {
            						peer.peer.close();
            						peer.peer = null;
            					}
            				}
            			}

            			var invokedOnce = false;

            			function selfInvoker() {
            				if (invokedOnce) return;

            				invokedOnce = true;

            				if (isofferer) peer.addAnswerSDP(inner.sdp);
            				else initPeer(inner.sdp);
            			}
            		}

            		function leave() {
            			var length = sockets.length;
            			for (var i = 0; i < length; i++) {
            				var socket = sockets[i];
            				if (socket) {
            					socket.send({
            						left: true,
            						userToken: self.userToken
            					});
            					delete sockets[i];
            				}
            			}

            			// if owner leaves; try to remove his room from all other users side
            			if (isbroadcaster) {
            				defaultSocket.send({
            					left: true,
            					userToken: self.userToken,
            					roomToken: self.roomToken
            				});
            			}

            			if (config.attachStream) config.attachStream.stop();
            		}

            		window.onbeforeunload = function() {
            			leave();
            		};

            		window.onkeyup = function(e) {
            			if (e.keyCode == 116) leave();
            		};

            		function startBroadcasting() {
            			defaultSocket && defaultSocket.send({
            				roomToken: self.roomToken,
            				roomName: self.roomName,
            				broadcaster: self.userToken
            			});
            			setTimeout(startBroadcasting, 3000);
            		}

            		function onNewParticipant(channel) {
            			if (!channel || channels.indexOf(channel) != -1 || channel == self.userToken) return;
            			channels += channel + '--';

            			var new_channel = uniqueToken();
            			openSubSocket({
            				channel: new_channel
            			});

            			defaultSocket.send({
            				participant: true,
            				userToken: self.userToken,
            				joinUser: channel,
            				channel: new_channel
            			});
            		}

            		function uniqueToken() {
            			var s4 = function() {
            				return Math.floor(Math.random() * 0x10000).toString(16);
            			};
            			return s4() + s4() + "-" + s4() + "-" + s4() + "-" + s4() + "-" + s4() + s4() + s4();
            		}

            		openDefaultSocket();
            		return {
            			createRoom: function(_config) {
            				self.roomName = _config.roomName || 'Anonymous';
            				self.roomToken = uniqueToken();

            				isbroadcaster = true;
            				isGetNewRoom = false;
            				startBroadcasting();
            			},
            			joinRoom: function(_config) {
            				self.roomToken = _config.roomToken;
            				isGetNewRoom = false;

            				self.joinedARoom = true;
            				self.broadcasterid = _config.joinUser;

            				openSubSocket({
            					channel: self.userToken
            				});

            				defaultSocket.send({
            					participant: true,
            					userToken: self.userToken,
            					joinUser: _config.joinUser
            				});
            			},
            			leaveRoom: leave
            		};
            	};

            	function getMediaElement(mediaElement, config) {
            		config = config || {};

            		if (!mediaElement.nodeName || (mediaElement.nodeName.toLowerCase() != 'audio' && mediaElement.nodeName.toLowerCase() != 'video')) {
            			if (!mediaElement.getVideoTracks().length) {
            				return getAudioElement(mediaElement, config);
            			}

            			var mediaStream = mediaElement;
            			mediaElement = document.createElement(mediaStream.getVideoTracks().length ? 'video' : 'audio');
            			mediaElement[!!navigator.mozGetUserMedia ? 'mozSrcObject' : 'src'] = !!navigator.mozGetUserMedia ? mediaStream : window.webkitURL.createObjectURL(mediaStream);
            		}

            		if (mediaElement.nodeName && mediaElement.nodeName.toLowerCase() == 'audio') {
            			return getAudioElement(mediaElement, config);
            		}

            		mediaElement.controls = false;

            		var buttons = config.buttons || ['mute-audio', 'mute-video', 'full-screen', 'volume-slider', 'stop'];
            		buttons.has = function(element) {
            			return buttons.indexOf(element) !== -1;
            		};

            		config.toggle = config.toggle || [];
            		config.toggle.has = function(element) {
            			return config.toggle.indexOf(element) !== -1;
            		};

            		var mediaElementContainer = document.createElement('div');
            		mediaElementContainer.className = 'media-container';

            		var mediaControls = document.createElement('div');
            		mediaControls.className = 'media-controls';
            		mediaElementContainer.appendChild(mediaControls);

            		if (buttons.has('mute-audio')) {
            			var muteAudio = document.createElement('div');
            			muteAudio.className = 'control ' + (config.toggle.has('mute-audio') ? 'unmute-audio selected' : 'mute-audio');
            			mediaControls.appendChild(muteAudio);

            			muteAudio.onclick = function() {
            				if (muteAudio.className.indexOf('unmute-audio') != -1) {
            					muteAudio.className = muteAudio.className.replace('unmute-audio selected', 'mute-audio');
            					mediaElement.muted = false;
            					mediaElement.volume = 1;
            					if (config.onUnMuted) config.onUnMuted('audio');
            				} else {
            					muteAudio.className = muteAudio.className.replace('mute-audio', 'unmute-audio selected');
            					mediaElement.muted = true;
            					mediaElement.volume = 0;
            					if (config.onMuted) config.onMuted('audio');
            				}
            			};
            		}

            		if (buttons.has('mute-video')) {
            			var muteVideo = document.createElement('div');
            			muteVideo.className = 'control ' + (config.toggle.has('mute-video') ? 'unmute-video selected' : 'mute-video');
            			mediaControls.appendChild(muteVideo);

            			muteVideo.onclick = function() {
            				if (muteVideo.className.indexOf('unmute-video') != -1) {
            					muteVideo.className = muteVideo.className.replace('unmute-video selected', 'mute-video');
            					mediaElement.muted = false;
            					mediaElement.volume = 1;
            					mediaElement.play();
            					if (config.onUnMuted) config.onUnMuted('video');
            				} else {
            					muteVideo.className = muteVideo.className.replace('mute-video', 'unmute-video selected');
            					mediaElement.muted = true;
            					mediaElement.volume = 0;
            					mediaElement.pause();
            					if (config.onMuted) config.onMuted('video');
            				}
            			};
            		}

            		if (buttons.has('take-snapshot')) {
            			var takeSnapshot = document.createElement('div');
            			takeSnapshot.className = 'control take-snapshot';
            			mediaControls.appendChild(takeSnapshot);

            			takeSnapshot.onclick = function() {
            				if (config.onTakeSnapshot) config.onTakeSnapshot();
            			};
            		}

            		if (buttons.has('stop')) {
            			var stop = document.createElement('div');
            			stop.className = 'control stop';
            			mediaControls.appendChild(stop);

            			stop.onclick = function() {
            				mediaElementContainer.style.opacity = 0;
            				setTimeout(function() {
            					if (mediaElementContainer.parentNode) {
            						mediaElementContainer.parentNode.removeChild(mediaElementContainer);
            					}
            				}, 800);
            				if (config.onStopped) config.onStopped();
            			};
            		}

            		var volumeControl = document.createElement('div');
            		volumeControl.className = 'volume-control';

            		if (buttons.has('record-audio')) {
            			var recordAudio = document.createElement('div');
            			recordAudio.className = 'control ' + (config.toggle.has('record-audio') ? 'stop-recording-audio selected' : 'record-audio');
            			volumeControl.appendChild(recordAudio);

            			recordAudio.onclick = function() {
            				if (recordAudio.className.indexOf('stop-recording-audio') != -1) {
            					recordAudio.className = recordAudio.className.replace('stop-recording-audio selected', 'record-audio');
            					if (config.onRecordingStopped) config.onRecordingStopped('audio');
            				} else {
            					recordAudio.className = recordAudio.className.replace('record-audio', 'stop-recording-audio selected');
            					if (config.onRecordingStarted) config.onRecordingStarted('audio');
            				}
            			};
            		}

            		if (buttons.has('record-video')) {
            			var recordVideo = document.createElement('div');
            			recordVideo.className = 'control ' + (config.toggle.has('record-video') ? 'stop-recording-video selected' : 'record-video');
            			volumeControl.appendChild(recordVideo);

            			recordVideo.onclick = function() {
            				if (recordVideo.className.indexOf('stop-recording-video') != -1) {
            					recordVideo.className = recordVideo.className.replace('stop-recording-video selected', 'record-video');
            					if (config.onRecordingStopped) config.onRecordingStopped('video');
            				} else {
            					recordVideo.className = recordVideo.className.replace('record-video', 'stop-recording-video selected');
            					if (config.onRecordingStarted) config.onRecordingStarted('video');
            				}
            			};
            		}

            		if (buttons.has('volume-slider')) {
            			var volumeSlider = document.createElement('div');
            			volumeSlider.className = 'control volume-slider';
            			volumeControl.appendChild(volumeSlider);

            			var slider = document.createElement('input');
            			slider.type = 'range';
            			slider.min = 0;
            			slider.max = 100;
            			slider.value = 100;
            			slider.onchange = function() {
            				mediaElement.volume = '.' + slider.value.toString().substr(0, 1);
            			};
            			volumeSlider.appendChild(slider);
            		}

            		if (buttons.has('full-screen')) {
            			var zoom = document.createElement('div');
            			zoom.className = 'control ' + (config.toggle.has('zoom-in') ? 'zoom-out selected' : 'zoom-in');

            			if (!slider && !recordAudio && !recordVideo && zoom) {
            				mediaControls.insertBefore(zoom, mediaControls.firstChild);
            			} else volumeControl.appendChild(zoom);

            			zoom.onclick = function() {
            				if (zoom.className.indexOf('zoom-out') != -1) {
            					zoom.className = zoom.className.replace('zoom-out selected', 'zoom-in');
            					exitFullScreen();
            				} else {
            					zoom.className = zoom.className.replace('zoom-in', 'zoom-out selected');
            					launchFullscreen(mediaElementContainer);
            				}
            			};

            			function launchFullscreen(element) {
            				if (element.requestFullscreen) {
            					element.requestFullscreen();
            				} else if (element.mozRequestFullScreen) {
            					element.mozRequestFullScreen();
            				} else if (element.webkitRequestFullscreen) {
            					element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            				}
            			}

            			function exitFullScreen() {
            				if (document.exitFullscreen) {
            					document.exitFullscreen();
            				} else if (document.webkitExitFullscreen) {
            					document.webkitExitFullscreen();
            				} else if (document.mozCancelFullScreen) {
            					document.mozCancelFullScreen();
            				} else if (document.msExitFullscreen) {
            					document.msExitFullscreen();
            				}
            			}

            			function screenStateChange(e) {
            				if (e.srcElement != mediaElementContainer) return;

            				var isFullScreeMode = document.webkitIsFullScreen || document.mozFullScreen || document.fullscreen;

            				mediaElementContainer.style.width = (isFullScreeMode ? (window.innerWidth - 20) : config.width) + 'px';
            				mediaElementContainer.style.display = isFullScreeMode ? 'block' : 'inline-block';

            				if (config.height) {
            					mediaBox.style.height = (isFullScreeMode ? (window.innerHeight - 20) : config.height) + 'px';
            				}

            				if (!isFullScreeMode && config.onZoomout) config.onZoomout();
            				if (isFullScreeMode && config.onZoomin) config.onZoomin();

            				if (!isFullScreeMode && zoom.className.indexOf('zoom-out') != -1) {
            					zoom.className = zoom.className.replace('zoom-out selected', 'zoom-in');
            					if (config.onZoomout) config.onZoomout();
            				}
            				setTimeout(adjustControls, 1000);
            			}

            			document.addEventListener('fullscreenchange', screenStateChange, false);
            			document.addEventListener('mozfullscreenchange', screenStateChange, false);
            			document.addEventListener('webkitfullscreenchange', screenStateChange, false);
            		}

            		if (buttons.has('volume-slider') || buttons.has('full-screen') || buttons.has('record-audio') || buttons.has('record-video')) {
            			mediaElementContainer.appendChild(volumeControl);
            		}

            		var mediaBox = document.createElement('div');
            		mediaBox.className = 'media-box';
            		mediaElementContainer.appendChild(mediaBox);

            		mediaBox.appendChild(mediaElement);

            		if (!config.width) config.width = (innerWidth / 2) - 50;

            		mediaElementContainer.style.width = config.width + 'px';

            		if (config.height) {
            			mediaBox.style.height = config.height + 'px';
            		}

            		mediaBox.querySelector('video').style.maxHeight = innerHeight + 'px';

            		var times = 0;

            		function adjustControls() {
            			mediaControls.style.marginLeft = (mediaElementContainer.clientWidth - mediaControls.clientWidth - 2) + 'px';

            			if (slider) {
            				slider.style.width = (mediaElementContainer.clientWidth / 3) + 'px';
            				volumeControl.style.marginLeft = (mediaElementContainer.clientWidth / 3 - 30) + 'px';

            				if (zoom) zoom.style['border-top-right-radius'] = '5px';
            			} else {
            				volumeControl.style.marginLeft = (mediaElementContainer.clientWidth - volumeControl.clientWidth - 2) + 'px';
            			}

            			volumeControl.style.marginTop = (mediaElementContainer.clientHeight - volumeControl.clientHeight - 2) + 'px';

            			if (times < 10) {
            				times++;
            				setTimeout(adjustControls, 1000);
            			} else times = 0;
            		}

            		if (config.showOnMouseEnter || typeof config.showOnMouseEnter === 'undefined') {
            			mediaElementContainer.onmouseenter = mediaElementContainer.onmousedown = function() {
            				adjustControls();
            				mediaControls.style.opacity = 1;
            				volumeControl.style.opacity = 1;
            			};

            			mediaElementContainer.onmouseleave = function() {
            				mediaControls.style.opacity = 0;
            				volumeControl.style.opacity = 0;
            			};
            		} else {
            			setTimeout(function() {
            				adjustControls();
            				setTimeout(function() {
            					mediaControls.style.opacity = 1;
            					volumeControl.style.opacity = 1;
            				}, 300);
            			}, 700);
            		}

            		adjustControls();

            		mediaElementContainer.toggle = function(clasName) {
            			if (typeof clasName != 'string') {
            				for (var i = 0; i < clasName.length; i++) {
            					mediaElementContainer.toggle(clasName[i]);
            				}
            				return;
            			}

            			if (clasName == 'mute-audio' && muteAudio) muteAudio.onclick();
            			if (clasName == 'mute-video' && muteVideo) muteVideo.onclick();

            			if (clasName == 'record-audio' && recordAudio) recordAudio.onclick();
            			if (clasName == 'record-video' && recordVideo) recordVideo.onclick();

            			if (clasName == 'stop' && stop) stop.onclick();

            			return this;
            		};

            		mediaElementContainer.media = mediaElement;

            		return mediaElementContainer;
            	}

            	// __________________
            	function getAudioElement(mediaElement, config) {
            		config = config || {};

            		if (!mediaElement.nodeName || (mediaElement.nodeName.toLowerCase() != 'audio' && mediaElement.nodeName.toLowerCase() != 'video')) {
            			var mediaStream = mediaElement;
            			mediaElement = document.createElement('audio');
            			mediaElement[!!navigator.mozGetUserMedia ? 'mozSrcObject' : 'src'] = !!navigator.mozGetUserMedia ? mediaStream : window.webkitURL.createObjectURL(mediaStream);
            		}

            		config.toggle = config.toggle || [];
            		config.toggle.has = function(element) {
            			return config.toggle.indexOf(element) !== -1;
            		};

            		mediaElement.controls = false;
            		mediaElement.play();

            		var mediaElementContainer = document.createElement('div');
            		mediaElementContainer.className = 'media-container';

            		var mediaControls = document.createElement('div');
            		mediaControls.className = 'media-controls';
            		mediaElementContainer.appendChild(mediaControls);

            		var muteAudio = document.createElement('div');
            		muteAudio.className = 'control ' + (config.toggle.has('mute-audio') ? 'unmute-audio selected' : 'mute-audio');
            		mediaControls.appendChild(muteAudio);

            		muteAudio.style['border-top-left-radius'] = '5px';

            		muteAudio.onclick = function() {
            			if (muteAudio.className.indexOf('unmute-audio') != -1) {
            				muteAudio.className = muteAudio.className.replace('unmute-audio selected', 'mute-audio');
            				mediaElement.muted = false;
            				if (config.onUnMuted) config.onUnMuted('audio');
            			} else {
            				muteAudio.className = muteAudio.className.replace('mute-audio', 'unmute-audio selected');
            				mediaElement.muted = true;
            				if (config.onMuted) config.onMuted('audio');
            			}
            		};

            		if (!config.buttons || (config.buttons && config.buttons.indexOf('record-audio') != -1)) {
            			var recordAudio = document.createElement('div');
            			recordAudio.className = 'control ' + (config.toggle.has('record-audio') ? 'stop-recording-audio selected' : 'record-audio');
            			mediaControls.appendChild(recordAudio);

            			recordAudio.onclick = function() {
            				if (recordAudio.className.indexOf('stop-recording-audio') != -1) {
            					recordAudio.className = recordAudio.className.replace('stop-recording-audio selected', 'record-audio');
            					if (config.onRecordingStopped) config.onRecordingStopped('audio');
            				} else {
            					recordAudio.className = recordAudio.className.replace('record-audio', 'stop-recording-audio selected');
            					if (config.onRecordingStarted) config.onRecordingStarted('audio');
            				}
            			};
            		}

            		var volumeSlider = document.createElement('div');
            		volumeSlider.className = 'control volume-slider';
            		volumeSlider.style.width = 'auto';
            		mediaControls.appendChild(volumeSlider);

            		var slider = document.createElement('input');
            		slider.style.marginTop = '11px';
            		slider.style.width = ' 200px';

            		if (config.buttons && config.buttons.indexOf('record-audio') == -1) {
            			slider.style.width = ' 241px';
            		}

            		slider.type = 'range';
            		slider.min = 0;
            		slider.max = 100;
            		slider.value = 100;

            		slider.oninput = function() {
            			mediaElement.volume = slider.value / 100;
            		};

            		volumeSlider.appendChild(slider);

            		var stop = document.createElement('div');
            		stop.className = 'control stop';
            		mediaControls.appendChild(stop);

            		stop.onclick = function() {
            			mediaElementContainer.style.opacity = 0;
            			setTimeout(function() {
            				if (mediaElementContainer.parentNode) {
            					mediaElementContainer.parentNode.removeChild(mediaElementContainer);
            				}
            			}, 800);
            			if (config.onStopped) config.onStopped();
            		};

            		stop.style['border-top-right-radius'] = '5px';
            		stop.style['border-bottom-right-radius'] = '5px';

            		var mediaBox = document.createElement('div');
            		mediaBox.className = 'media-box';
            		mediaElementContainer.appendChild(mediaBox);

            		var h2 = document.createElement('h2');
            		h2.innerHTML = config.title || 'Audio Element';
            		h2.setAttribute('style', 'position: absolute;color: rgb(160, 160, 160);font-size: 20px;text-shadow: 1px 1px rgb(255, 255, 255);padding:0;margin:0;');
            		mediaBox.appendChild(h2);

            		mediaBox.appendChild(mediaElement);

            		mediaElementContainer.style.width = '329px';
            		mediaBox.style.height = '90px';

            		h2.style.width = mediaElementContainer.style.width;
            		h2.style.height = '50px';
            		h2.style.overflow = 'hidden';

            		var times = 0;

            		function adjustControls() {
            			mediaControls.style.marginLeft = (mediaElementContainer.clientWidth - mediaControls.clientWidth - 7) + 'px';
            			mediaControls.style.marginTop = (mediaElementContainer.clientHeight - mediaControls.clientHeight - 6) + 'px';
            			if (times < 10) {
            				times++;
            				setTimeout(adjustControls, 1000);
            			} else times = 0;
            		}

            		if (config.showOnMouseEnter || typeof config.showOnMouseEnter === 'undefined') {
            			mediaElementContainer.onmouseenter = mediaElementContainer.onmousedown = function() {
            				adjustControls();
            				mediaControls.style.opacity = 1;
            			};

            			mediaElementContainer.onmouseleave = function() {
            				mediaControls.style.opacity = 0;
            			};
            		} else {
            			setTimeout(function() {
            				adjustControls();
            				setTimeout(function() {
            					mediaControls.style.opacity = 1;
            				}, 300);
            			}, 700);
            		}

            		adjustControls();

            		mediaElementContainer.toggle = function(clasName) {
            			if (typeof clasName != 'string') {
            				for (var i = 0; i < clasName.length; i++) {
            					mediaElementContainer.toggle(clasName[i]);
            				}
            				return;
            			}

            			if (clasName == 'mute-audio' && muteAudio) muteAudio.onclick();
            			if (clasName == 'record-audio' && recordAudio) recordAudio.onclick();
            			if (clasName == 'stop' && stop) stop.onclick();

            			return this;
            		};

            		mediaElementContainer.media = mediaElement;

            		return mediaElementContainer;
            	}
            	var enciendocam = 'no';
            	var config = {
            		openSocket: function(cfg) {
            			const SIGNALING_SERVER = 'https://socket.kekocity.es:8443/';
            			let defaultChannel = location.hash.substr(1);
            			if (!defaultChannel || defaultChannel === 'hi') {
            				defaultChannel = idkekoyo;
            				location.hash = defaultChannel;
            				const uniqueTokenEl = document.getElementById('unique-token');
            				if (uniqueTokenEl) uniqueTokenEl.textContent = defaultChannel;
            				enciendocam = 'si';
            			}

            			const channel = cfg.channel || defaultChannel;
            			const sender = Math.floor(Math.random() * 900000000) + 100000000;

            			// crear o reutilizar mainSocket
            			if (!window._mainSocket) {
            				window._mainSocket = io(SIGNALING_SERVER, {
            					transports: ['websocket']
            				});
            				window._mainSocket.on('connect', () => console.log('[mainSocket] conectado'));
            			}

            			// ¡emitir siempre new-channel para este canal/sender!
            			window._mainSocket.emit('new-channel', {
            				channel: channel,
            				sender: sender
            			});

            			// conexión al namespace
            			const socket = io(`${SIGNALING_SERVER}${channel}`, {
            				transports: ['websocket']
            			});
            			socket.channel = channel;

            			socket.once('namespace-ready', () => {
            				console.log('[Socket.IO] namespace-ready ->', channel);
            				if (cfg.callback) cfg.callback(socket);

            				if (enciendocam === 'si') {
            					const btn = document.getElementById('setup-new-room');
            					if (btn) {
            						if (!/iP(ad|hone|od)/i.test(navigator.userAgent)) {
            							btn.click();
            						} else {
            							btn.style.display = 'inline-block';
            						}
            					}
            				}
            			});

            			socket.on('disconnect', () => console.log('[Socket.IO] disconnected', channel));
            			socket.on('close', () => console.log('[Socket.IO] closed', channel));

            			socket.send = function(message) {
            				socket.emit('message', {
            					sender: sender,
            					data: message
            				});
            			};
            			socket.on('message', cfg.onmessage);

            			// devolver socket por si lo necesitas
            			return socket;
            		},

            		onRemoteStream: function(media) {
            			const mediaElement = getMediaElement(media.video, {
            				width: (videosContainer.clientWidth / 2),
            				buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider']
            			});
            			mediaElement.id = media.streamid;
            			videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
            		},

            		onRemoteStreamEnded: function(stream, video) {
            			const container = video?.parentNode?.parentNode?.parentNode;
            			if (container?.parentNode) {
            				container.parentNode.removeChild(container);
            			}
            		},

            		onRoomFound: function(room) {
            			if (yaconectadoso === 'n' && room.roomName && room.roomName === ikave) {
            				yaconectadoso = 's';
            				if (document.querySelector(`button[data-broadcaster="${room.broadcaster}"]`)) return;

            				if (typeof roomsList === 'undefined') roomsList = document.body;

            				const tr = document.createElement('tr');
            				tr.innerHTML = ` <td style="display:none"><strong>${room.roomName}</strong></td> <td style="display:none"><button class="join"></button></td>`;
            				roomsList.insertBefore(tr, roomsList.firstChild);

            				const joinRoomButton = tr.querySelector('.join');
            				joinRoomButton.dataset.broadcaster = room.broadcaster;
            				joinRoomButton.dataset.roomToken = room.roomToken;
            				joinRoomButton.onclick = function() {
            					this.disabled = true;
            					conferenceUI.joinRoom({
            						roomToken: this.dataset.roomToken,
            						joinUser: this.dataset.broadcaster
            					});
            				};
            				joinRoomButton.click();
            			}
            		},

            		onRoomClosed: function(room) {
            			const joinButton = document.querySelector(`button[data-roomToken="${room.roomToken}"]`);
            			if (joinButton) {
            				const tr = joinButton.closest('tr');
            				if (tr?.parentNode) tr.parentNode.removeChild(tr);
            			}
            		}
            	};

            	function setupNewRoomButtonClickHandler() {
            		btnSetupNewRoom.disabled = true;
            		document.getElementById('conference-name').disabled = true;
            		captureUserMedia(() => {
            			conferenceUI.createRoom({
            				roomName: (document.getElementById('conference-name')?.value || 'Anonymous')
            			});
            		});
            	}
            	async function captureUserMedia(callback) {
            		const video = document.createElement('video');
            		video.setAttribute('muted', true);
            		video.setAttribute('playsinline', true); // iOS Safari inline playback

            		try {
            			const stream = await navigator.mediaDevices.getUserMedia({
            				video: true,
            				audio: true
            			});
            			config.attachStream = stream;
            			callback?.();

            			video.srcObject = stream;
            			video.play().catch(err => console.warn('Video play blocked:', err));

            			const mediaElement = getMediaElement(video, {
            				width: videosContainer.clientWidth / 2,
            				buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider']
            			});
            			mediaElement.toggle('mute-audio');
            			videosContainer.insertBefore(mediaElement, videosContainer.firstChild);

            			if (enciendocam === 'si') {
            				parent.masfuncs('ecamsi', '', '', '', '');
            				window.parent.document.getElementById('ifra' + ikave).querySelector('iframe').className = 'ifracams';
            			}

            		} catch (err) {
            			console.error('Error capturando cámara/micrófono:', err);
            			callback?.();
            			parent.masfuncs('myAle', 'nowebcam', ikave, '', '');
            		}
            	}

            	const conferenceUI = conference(config);

            	/* UI specific */
            	const videosContainer = document.getElementById('videos-container') || document.body;
            	const btnSetupNewRoom = document.getElementById('setup-new-room');
            	const roomsList = document.getElementById('rooms-list');

            	btnSetupNewRoom?.addEventListener('click', setupNewRoomButtonClickHandler);

            	function rotateVideo(video) {
            		video.style.transform = 'rotate(0deg)';
            		setTimeout(() => {
            			video.style.transform = 'rotate(360deg)';
            		}, 1000);
            	}

            	function scaleVideos() {
            		const videos = document.querySelectorAll('video');
            		videos.forEach(video => {
            			video.style.maxHeight = '100%';
            		});
            	}

            	window.addEventListener('resize', scaleVideos);
            };
         </script>
      </article>
   </body>
</html>
