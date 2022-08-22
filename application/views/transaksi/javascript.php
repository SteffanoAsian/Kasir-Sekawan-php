<script type="text/javascript">
function showDetail(el){
    var data = $(el).find('option:selected').data();
    var hargashow = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(data.harga);
    
    $('#jumlah').val(0)
    $('#showStok').html(data.stok)
    $('#showHarga').html(hargashow)
    $('#showKategori').html(data.kategori)
    $('[name=keranjang_id]').val("")
}

function qtyCheck(el){
    var Input =$(el).val();
    var stock = parseInt($('#showStok').text());

    if(Input > stock){
        alert("Jumlah Tidak Dapat Melebihi Stock Barang");
        $(el).val(0);
    }
    // if(stock = "0"){
    //     alert("Stock Barang Tidak Tersedia");
    //     $(el).val();
    // }

}

function editKeranjang(el){
    var data = $(el).data()
    $('#barang_id').val(data.barangid).trigger('change')
    $('#jumlah').val(data.jumlah)
    $('#showStok').html(data.jumlah+data.stok)
    $('[name=keranjang_id]').val(data.keranjangid)
}

function balek(el){
    var uang = $(el).val()
    var total = $('#total').val()
    console.log(total)
    var kembali = uang - total
    var kembalian = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(kembali);
    if(kembali<0){
        $('#showKembali').val("0")
    }else{
        $('#showKembali').val(kembalian)
        $('#kembali').val(kembali)
    }
    
}

function cekProses(){
    var uang = $('#jumlah').val()
    var total = $('#total').val()

    if(total>uang){
        alert("Uang anda tidak Mencukupi")
    }
}
</script>