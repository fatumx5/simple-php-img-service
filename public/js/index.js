  var height;
    var width;

    (function() {
      var time;
      window.onload = function(e) {
        if (time)
          clearTimeout(time);
        time = setTimeout(function() {
          height = window.innerWidth;
          width = window.innerHeight;
        }, 0);
      }
    })();


    (function() {
      var time;
      window.onresize = function(e) {
        if (time)
          clearTimeout(time);
        time = setTimeout(function() {
          height = window.innerWidth;
          width = window.innerHeight;
        }, 0);
      }
    })();


    var img = document.getElementsByClassName('img-container-el');
    for (var i = 0; i < img.length; i++) {
      img[i].onclick = function() {

        currentImg = this.innerHTML;
        currentImg_L = currentImg.replace(/_S/, '');
        document.getElementById('modal').innerHTML = currentImg_L;
        modalImage = document.getElementById('modal').getElementsByTagName('img')[0];



        if (height < width) {

          modalImage.style.height = (height-height/4)*0.9 + 'px';
          modalImage.style.width = 'auto';
        } else {
          modalImage.style.width = width + 'px';
          modalImage.style.heght = 'auto';

        }

        modalImage.style.paddingLeft = '5px';
        modalImage.style.paddingTop = '10px';

        document.getElementById('shadow').style.display = 'block';

        modalImage.onclick = function() {
          document.getElementById('modal').innerHTML = '';
          document.getElementById('shadow').style.display = 'none';
        }
        document.getElementById('shadow').onclick = function() {
          document.getElementById('modal').innerHTML = '';
          document.getElementById('shadow').style.display = 'none';
        }

      }
    }