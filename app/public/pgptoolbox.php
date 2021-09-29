<div class="pgp-toolbox">
    <div class="tab">
        <button class="tablink" onclick="openTab(event, 'First')" id="defaultTab">Generate Key</button>
        <button class="tablink" onclick="openTab(event, 'Second')">Sign</button>
        <button class="tablink" onclick="openTab(event, 'Third')">Verify</button>
        <button class="tablink" onclick="openTab(event, 'Fourth')">Revocation</button>
    </div>

    <div id="First" class="tabcontent">
        <div class="keygen-options">
            <div class="row">
            <div class="column">
                <h3>Options</h3>
                <form id="keygen">
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" id="username" name="username" class="form-control"
                            placeholder="user@domain.com">
                    </div>
                    <div class="form-group">
                        <label for="username">Comments</label>
                        <input type="text" id="username" name="username" class="form-control"
                            placeholder="Comments (optional)">
                    </div>
                    <div class="form-group">
                        <label for="username">Key Size</label>
                        <select type="text" id="username" name="username" class="form-control" placeholder="Your Name">
                            <option value="1024">1024 bits (testing)</option>
                            <option value="1024">2048 bits (secure)</option>
                            <option value="1024">4096 bits (more secure) [Recommended]</option>
                            <option value="1024">8192 bits (paranoid, slow)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Expiration</label>
                        <select type="text" id="username" name="username" class="form-control" placeholder="Your Name">
                            <option value="1024">Never</option>
                            <option value="1024">1 years</option>
                            <option value="1024">2 years</option>
                            <option value="1024">4 years</option>
                            <option value="1024">8 years</option>
                        </select>
                    </div>
                    <input value="Generate" class="button" type="submit">
                </form>
            </div>
            <div class="column">
                <div class="keygen-output">
                <h3>Public Key</h3>
                <textarea rows="7" cols="30"></textarea>
            <h3>Private Key</h3>
            <textarea rows="7" cols="30"></textarea>
                 </div>
            </div>
        </div>
</div>
    </div>
    <div id="Second" class="tabcontent">
        <h3>Unavailable</h3>
    </div>
    <div id="Third" class="tabcontent">
        <h3>Unavailable</h3>
    </div>
    <div id="Fourth" class="tabcontent">
        <h3>Unavailable</h3>
    </div>

    <script> document.getElementById("defaultTab").click(); </script>
</div>