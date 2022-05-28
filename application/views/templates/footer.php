        </div>
    </div>

<script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" language="JavaScript">
        function konfirmasi() {
            tanya = confirm("Anda Yakin Akan Menghapus Data ?");
            if (tanya == true) return true;
            else return false;
        }

        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57) )
    
            return false;
          return true;
        }

        function harusHuruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
}
    </script>
  </div>
</body>
</html>
