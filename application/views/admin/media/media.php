<?php
//dump($this->_ci_cached_vars);
if (isset($media->id)) {
    ?>
    <div id="media">
        <h4><?= $media->name ?></h4>

        <?php
        switch ($media->tag) {
            case 'gallery':
                ?>
                <div style="margin: auto; width: 400px;">
                    <ul id="lightSlider" class="gallery list-unstyled cS-hidden">
                        <?php foreach ($media->flickr['photoset']['photo'] as $photo) { ?>
                            <li data-thumb="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>_t.jpg">
                                <img u="image" src="https://farm<?= $photo['farm'] ?>.staticflickr.com/<?= $photo['server'] ?>/<?= $photo['id'] ?>_<?= $photo['secret'] ?>.jpg" />
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php
                break;

            case 'video':
                ?>
                <div id="player" align="middle"></div>

            <?php
        }
        ?>
    </div><?php } else { ?>
    <p>Vsebina ne obstaja.</p>
<?php } ?>

<script>
// 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '390',
            width: '600',
            videoId: '<?= $media->link; ?>',
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

// 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            setTimeout(stopVideo, 6000);
            done = true;
        }
    }
    function stopVideo() {
        player.stopVideo();
    }
</script>



