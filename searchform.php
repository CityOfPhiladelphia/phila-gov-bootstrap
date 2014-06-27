<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
    <fieldset>
            <div class="left-inner-addon">
                <span class="glyphicon glyphicon-search"></span>
                <input type="text" name="s" id="search" placeholder="<?php _e("What are you looking for?","wpbootstrap"); ?>" value="<?php the_search_query(); ?>" class="form-control" />
            </div>
            <span class="input-group-btn hide">
                <button type="submit" class="btn btn-default"></button>
            </span>
    </fieldset>
</form>