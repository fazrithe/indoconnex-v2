<script>
	function selectUserinbox(id){
    user_id = $("#id").val();
    if(id == 1){
	    document.getElementById('select_user_id_inbox').value = user_id;
        document.getElementById('select_business_id_inbox').value = '';
    }else{
        document.getElementById('select_business_id_inbox').value = id;
        document.getElementById('select_user_id_inbox').value = '';
    }
}
</script>
