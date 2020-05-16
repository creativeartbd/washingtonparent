<div class="header-calendar-search-wrapper calendar-2 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>search our Calendar</h2>      
                <form action="<?php echo ecp_get_page_url( 'events_page' ); ?>" method="get" autocomplete="off">                  
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <select name="event_category" id="event_category" class="form-control">
                                <option value="">Category</option>
                                <?php 
                                foreach ( ecp_get_all_event_categories( 'term_id' ) as $term_id => $name ) {
								    echo sprintf( '<option value="%s" %s >%s</option>', $term_id, $category === $term_id ? 'selected' : '', $name );
                                } 
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <select name="" id="" class="form-control">
                                    <option value="">Date Range</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group input-icon">
                                <input type="text" class="ecp-date-calendar form-control" name="start_date" placeholder="Start Date / <?php echo date( 'd-m-Y'); ?>">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group input-icon">
                                <input type="text" class="ecp-date-calendar form-control" name="end_date" placeholder="Start Date / <?php echo date( 'd-m-Y'); ?>">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                        </div>                      
               
                        <div class="col-sm-6 col-md-6 col-lg-3 input-icon">
                            <div class="form-group input-icon">
                                <input type="search" class="form-control" placeholder="Search for..." name="search_keyword" value="<?php echo ( ! empty( $_GET['search_keyword'] ) ) ? wp_unslash( $_GET['search_keyword'] ) : ''; ?>">
                                <i class="fa fa-search search-icon" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">&nbsp;&nbsp;View reader submitted</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 hide-less-to-col">
                            <div class="form-group">
                                <div class="calendar-search-btn-wrapper">                                        
                                    <div class="calendar-btn-group">
                                        <a href="<?php echo ecp_get_page_url( 'event_submit_page' ); ?>">Submit Listing</a>
                                        <a href="<?php echo ecp_get_page_url( 'events_page' ); ?>">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Search">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 hide-greater-to-col">
                            <div class="form-group">
                                <div class="calendar-search-btn-wrapper">                                        
                                    <div class="calendar-btn-group">
                                        <a href="<?php echo ecp_get_page_url( 'event_submit_page' ); ?>">Submit Listing</a>
                                        <a href="<?php echo ecp_get_page_url( 'events_page' ); ?>">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>