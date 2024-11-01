(function( $ ){
   $.fn.treeview = function() {
    var
        $table = this,
        rows = $table.find('tr');

    rows.each(function (index, row) {
      var
          $row = $(row),
          level = $row.data('level'),
          id = $row.data('id'),
          $columnName = $row.find('td[data-column="first"]'),
          children = $table.find('tr[data-parent="' + id + '"]');


      if (children.length) {
        var expander = $columnName.prepend('' + '<span class="treegrid-expander fas fa-angle-right"></span>' + '');
        // children.show();
        children.hide();

        expander.on('click', function (e) {
          var $target = $(e.target);
          if ($target.hasClass('fa-angle-right')) {
            $target.removeClass('fa-angle-right').addClass('fa-angle-down');
            children.show();
          } else if($target.hasClass('fa-angle-down')) {
            $target.removeClass('fa-angle-down').addClass('fa-angle-right');
            reverseHide($table, $row);
          }
        });
      }

      $columnName.prepend('' + '<span class="treegrid-indent" style="width:' + 15 * level + 'px"></span>' + '');
    });

    // Reverse hide all elements
    reverseHide = function (table, element) {
      var
        $element = $(element),
        id = $element.data('id'),
        children = table.find('tr[data-parent="' + id + '"]');

      if (children.length) {
        children.each(function (i, e) {
            reverseHide(table, e);
        });

        $element.find('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-right');

        children.hide();
      }
    };

    // Show All List
    $('.btn-show-list').click(function(){
      rows.each(function (index, row) {
        var
          $row = $(row),
          level = $row.data('level'),
          id = $row.data('id'),
          $columnName = $row.find('td[data-column="first"]'),
          children = $table.find('tr[data-parent="' + id + '"]');

        if (children.length) {
          var expander = $columnName.find('.treegrid-expander');
          expander.removeClass('fa-angle-right').addClass('fa-angle-down');
          children.show();
        }
      });
    });

    // Hide All List
    $('.btn-hide-list').click(function(){
      rows.each(function (index, row) {
        var
          $row = $(row),
          level = $row.data('level'),
          id = $row.data('id'),
          $columnName = $row.find('td[data-column="first"]'),
          children = $table.find('tr[data-parent="' + id + '"]');

        if (children.length) {
          var expander = $columnName.find('.treegrid-expander');
          expander.removeClass('fa-angle-down').addClass('fa-angle-right');
          children.hide();
        }
      });
    });

    return this;
  };
})( jQuery );
