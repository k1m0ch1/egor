    var dragSrcEl = null;

    function handleDragStart(e) {
        // Target (this) element is the source node.
        //this.style.opacity = '0.4';

        dragSrcEl = this;

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {

        this.style.opacity = '0.4';
        if (e.preventDefault) {
            e.preventDefault(); // Necessary. Allows us to drop.
        }

        e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

        return false;
    }

    function handleDragEnter(e) {
        // this / e.target is the current hover target.
        this.classList.add('over');
    }

    function handleDragLeave(e) {
        this.style.opacity = '1';
        this.classList.remove('over');  // this / e.target is previous target element.
    }

    function handleDrop(e) {
        // this/e.target is current target element.
        this.style.opacity = '1';

        if (e.stopPropagation) {
            e.stopPropagation(); // Stops some browsers from redirecting.
        }

        // Don't do anything if dropping the same column we're dragging.
        if (dragSrcEl != this) {
            // Set the source column's HTML to the HTML of the column we dropped on.
            dragSrcEl.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');
            $.getScript(  dir_host + "assets/js/tesRecall.js" )
              .done(function( script, textStatus ) {
              })
              .fail(function( jqxhr, settings, exception ) {
                $( "div.log" ).text( "Triggered ajaxError handler." );
            });
            // for(xx=0;xx<9;xx++){
            //     var aw = $('#idGambar' + xx).parent();
            //     console.log($('tr td').index(aw));
            // }
            // for(var i = 1; i < cells.length; i++){
            //     // Cell Object
            //     var cell = cells[i];
            //     // Track with onclick
            //     cell.onclick = function(){
            //         var cellIndex  = this.cellIndex + 1;

            //         var rowIndex = this.parentNode.rowIndex + 1;

            //         alert("cell: " + cellIndex + " / row: " + rowIndex );
            //     }
            // }
        }

        return false;
    }

    function handleDragEnd(e) {
        // this/e.target is the source node.

        [].forEach.call(cols, function (col) {
            col.classList.remove('over');
        });
    }
