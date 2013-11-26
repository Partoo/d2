var Script = function () {

    //chosen select
    $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});


    //tag input

    function onAddTag(tag) {
        alert("添加主题词: " + tag);
    }
    function onRemoveTag(tag) {
        alert("删除主题词: " + tag);
    }

    function onChangeTag(input,tag) {
        alert("修改主题词: " + tag);
    }

    $(function() {

        $('#keyword').tagsInput({width:'auto'});
        // Uncomment this line to see the callback functions in action
        //          $('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});

        // Uncomment this line to see an input with no interface for adding new tags.
        //          $('input.tags').tagsInput({interactive:false});
    });

    //date picker




}();