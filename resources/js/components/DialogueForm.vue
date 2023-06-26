<template>
    <div class="submitMessageContainer" >
        <div class="mb-3 form1">
            <textarea @keyup="typing" @keyup.enter="sendMessage" v-model="form.content" maxlength='250' name="content" type="text" class="form-control" id="messageInput" placeholder="сообщение" required autofocus></textarea>
            <button @click="sendMessage" type="submit" id="submit" class="btn btn-primary button1" title="Enter - отправить, Shift+Enter - перенос строки">Отправить</button>
            <span id ="flag" class="flag"></span>
        </div>
    </div>
</template>

<script>
import {reactive} from "vue";
import useDialogue from "@/composibles/dialogue.js";

export default {
    name: 'DialogueForm',
    props: {
        dialogue_id: {
            required: true,
            type: String
        }
    },
    setup(props) {
        const form = reactive({
            content: '',
        })

        const {errors, addMessage, editMessage, typingMessage} = useDialogue()

        const sendMessage = async (event) => {
            if (document.getElementById('flag') != undefined) {
                if (event.shiftKey !== true) {
                    await addMessage(form, props.dialogue_id)
                    form.content = ''
                }
            }
            else {
                let submitButton = document.getElementById('submit')
                submitButton.innerHTML = 'изменить'

                let flag = document.querySelector('.flag');

                editMessage(form, flag.id)
                form.content = ''

                flag.id = 'flag'
            }
        }

        let canTyping = true

        const typing = async () => {
            if (canTyping) {
                canTyping = false

                typingMessage()

                setTimeout(function () {
                    canTyping = true
                }, 2000);
            }
        }

        return {
            errors,
            form,
            sendMessage,
            typing
        }
    }
}
</script>

<style scoped>

</style>
