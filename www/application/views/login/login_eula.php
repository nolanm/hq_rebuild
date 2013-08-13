
<div class="container">
    
    
    <h1>LocalMark License Agreement</h1>

    <?php  echo form_open('login/eula', array('class'=>'form-horizontal'));?>
    
    <p>
        <textarea class="span8" rows="20" readonly wrap="soft">SOFTWARE LICENSE AGREEMENT
			By clicking the "Accept" button below you accept a non-transferable and non-exclusive license to use this McDonald's LocalMark.com ("Software") Your right to use the Software is limited solely to the right to use it in the operation of your McDonald's restaurant. You shall not, nor permit others to (a) use, copy or transfer the Software, (b) copy in any manner any documentation supplied as part of the Software ("the Documentation"), or(c) alter, adapt, modify or translate the Software in any way for any purpose. The term of the License shall be for as long as you own your McDonald's restaurant, however this license may be terminated immediately for your breach.

			This Software is provided on an "AS-IS" basis. No warranties, conditions, terms, representations, express or implied, statutory or otherwise are given or assumed by McDonald's Corporation, and without limitation the implied terms of merchantability and fitness for a particular purpose are excluded. No warranty is made that the operation of the Software will be uninterrupted or error free. In no event will either McDonald's Corporation be liable for any direct, consequential, incidental or special damage or loss of any kind (including without limitation loss of profits, loss of contracts, business interruptions, loss of or corruption to data or loss of anticipated savings) whether arising under contract or tort, including negligence or otherwise.

			You acknowledge that with your use of the Software, you will follow McDonald's Internet, Trademark, and Copyright Policies and Guidelines (contained within the LocalMark.com administrative interface) as these Policies and Guidelines may be amended, changed or modified from time to time by McDonald's Corporation. Any failure by you to follow these Policies and Guidelines shall be a breach of this License.

			Nothing contained in this License shall amend or modify the Franchise Agreement for your McDonald's restaurant. 

			This License is personal to you and you may not assign or otherwise transfer its rights or obligations without Licensor's prior written consent, except that you may assign it to the purchaser in the event that you sell your McDonald's restaurant. Further, you acknowledge that the Software, its Documentation and all related materials provided hereunder are the confidential and proprietary property of McDonald's Corporation. This License shall be construed in accordance with and governed by the laws of the State of Illinois.
        </textarea>
    </p>
    
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Yes, I accept</button>
            <?php echo anchor('/','No, thanks.','class="btn btn-link"'); ?>
        </div>
    </div>
    </form>

</div>

