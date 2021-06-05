<!-- Contact -->
<section class="contact-section">
    <form method="post" action="/contact">
        <div class="fields">
            <div class="field half">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Michael" required value="<?=$user->name?>"/>
            </div>
            <div class="field half">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="micheal77@handong.edu" value="<?=$user->email?>" required/>
            </div>
            <div class="field">
                <label for="message">Message</label>
                <textarea name="message" id="message" rows="4"></textarea>
            </div>
        </div>
        <ul class="actions">
            <li><input type="submit" value="Send Message" class="primary" /></li>
        </ul>
    </form>
    
</section>


