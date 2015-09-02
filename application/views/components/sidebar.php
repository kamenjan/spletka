<div class="col-xs-12">

    <div class="SS_calendar"></div>

    <hr class="seperator">

    <div class="SS_links">
        <img src="<?= base_url('assets/images/facebook_logo1.png') ?>" alt="Facebook Logo">
        <img src="<?= base_url('assets/images/flickr_logo.png') ?>" alt="Facebook Logo">
        <img src="<?= base_url('assets/images/twitter_logo.png') ?>" alt="Facebook Logo">
    </div> 

    <hr class="seperator">

    <div class="SS_latest_posts"> 
        <h3>ne spreglej:</h3>
        <?php foreach ($announcements as $post) { ?>
            <a  href="<?= base_url() ?>post/show_post/<?= $post->id ?>"><p><?= $post->title ?></p></a>
            <p><?= date('d.m.y', strtotime($post->date_created)) . ' | ' . translate($post->tag); ?></p>
        <?php } ?>
    </div>  

    <hr class="seperator">

    <?php if ($this->session->userdata['survey'] == FALSE) { ?>
        <div id="SS_survey" style="text-align: center;">
            <div><?= $survey->question ?></div>

            <?php foreach ($survey->answers as $answer) { ?>
                <input type="radio" name="answer" value="<?= $answer->id ?>"/>   <?= $answer->answer ?><br />
            <?php }
            ?>
            <input type="submit" id="submit_btn" value="Submit" />

        </div>
        <?php
    }
    ?>

    <div id="SS_piechart" style="width: auto; height: 100px;"></div>

    <?php if ($this->session->userdata['survey'] == TRUE) { ?>


        <?php
    }
    ?>

    <hr class="seperator">

    <div class="SS_info"> 
        <h4>Društvo za kulturo in izobraževanje IMPRO</h4>
        <p>Vošnjakova ulica 5</p>
        <p>1000 Ljubljana</p>
        <p>davčna številka: 43366902</p>
        <p>TRR: SI56 0201 0025 9932 127 (NLB)</p>
        <p>kdokjekaj@gmail.com</p>
    </div>

</div>
