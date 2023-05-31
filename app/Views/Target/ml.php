<style> 
.form-control:focus, .form-control:valid {
  box-shadow: -3px -3px 15px rgb(255, 0, 255);
  transition: .1s;
  transition-property: box-shadow;
}
</style>

<div class="form-row pt-4">
    <div class="inputbox col">
    <label><b>User ID</b></label>
        <input type="number" class="form-control" name="user_id" id="user_id" placeholder="User ID" required autocomplete="off" onkeyup="saveValue(this)">
    </div>
    &nbsp;&nbsp;
    <div class="inputbox col">
    <label><b>Server ID</b></label>
        <input type="number" class="form-control" name="zone_id" id="zone_id" placeholder="Server ID" required autocomplete="off" onkeyup="saveValue(this)">
    </div>
    <p class="col-12 mt-2" style="font-size: 10px">Untuk mengetahui User ID Anda, silahkan klik menu profile dibagian kiri atas pada menu utama game. User ID akan terlihat dibagian bawah Nama karakter game Anda. Silahkan masukan User ID dan Server ID Anda untuk menyelesaikan transaksi. <b>Contoh: 12345678(1234)</b>. </p>
</div>

<script type="text/javascript">
        document.getElementById("user_id").value = getSavedValue("user_id");    // set the value to this input
        document.getElementById("zone_id").value = getSavedValue("zone_id");   // set the value to this input
        /* Here you can add more inputs to set value. if it's saved */

        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(e){
            var id = e.id;  // get the sender's id to save it . 
            var val = e.value; // get the value. 
            localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
        }

        //get the saved value function - return the value of "v" from localStorage. 
        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return "";// You can change this to your defualt value. 
            }
            return localStorage.getItem(v);
        }
</script>