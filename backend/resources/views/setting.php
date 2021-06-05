<section class="contact-section">
    <form method="post" action="/setting">
        <div class="fields">
            <div class="field half">
                <label class="fcontainer">
                    <input type="radio" name="voice" value="1"  <?php if((int)($voice->voice_id) == 1): ?>checked="checked" <?php endif; ?> />
                    <span class="checkmark"></span> 
                    Normal English voice
                </label>
                <br>

                <label class="fcontainer">
                    <input type="radio" name="voice" value="2" <?php if((int)($voice->voice_id) == 2): ?>checked="checked" <?php endif; ?>/>
                    <span class="checkmark"></span> 
                    Normal Korean voice
                </label>
                <br>

                <label class="fcontainer">
                    <input type="radio" name="voice" value="3" <?php if((int)($voice->voice_id) == 3): ?>checked="checked" <?php endif; ?> />
                    <span class="checkmark"></span> 
                    Foreign Korean voice
                </label>
                <br>
                <h1>Current Setting : <?=$voice->name?></h1>
            </div>
        </div>
        <ul class="actions">
            <li><input type="submit" value="Change"/></li>
            <li><input type="reset" value="Reset" /></li>
        </ul>
    </form>
</section>