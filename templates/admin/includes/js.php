<script>
    // $(function() {
    //     var url = window.location;
    //     // for single sidebar menu
    //     $('ul.nav-sidebar a').filter(function() {
    //         return this.href == url;
    //     }).addClass('active');

    //     // for sidebar menu and treeview
    //     $('ul.nav-treeview a').filter(function() {
    //             return this.href == url;
    //         }).parentsUntil(".nav-sidebar > .nav-treeview")
    //         .css({
    //             'display': 'block'
    //         })
    //         .addClass('menu-open').prev('a')
    //         .addClass('active');
    // });
    /*** add active class and stay opened when selected ***/
    var url = window.location;
    var server = window.location.origin;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).addClass('active');
    //Dashboard
    window.location.href == `<?=base_url('admin')?>` || window.location.href == `<?=base_url('admin').'/'?>` ? $('.dashboard').removeClass('bg-secondary').addClass('active') : $('.dashboard').removeClass('active').addClass('bg-secondary');

    // for the treeview
    $('ul.nav-treeview a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>
<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#category_table').DataTable();
    });
</script>