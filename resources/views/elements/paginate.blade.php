<div class="row">
    <?php
        if (!empty($query)) {
            $records->appends($query);
        }
    ?>
    {!! $records->render() !!}
</div>
