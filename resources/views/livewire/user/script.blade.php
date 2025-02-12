<script type="text/javascript">
    document.addEventListener('livewire:init', () => {
        $('#perfil').on('change', function(){
            alert($(this).val());
        });
    });
</script>