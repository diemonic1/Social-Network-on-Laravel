import {ref} from 'vue';
import axios from "axios";
import moment from "moment";

export default function useDialogue(){
    const messages = ref([])
    const errors = ref([])

    const getMessages = async (dialogue_id) => {
        await axios.get('/dialogues/GetMessages/' + dialogue_id).then((response) => {
            let currentMessages = response.data
            let messagesWithDate = {}

            if (response.data.length > 0) {
                let currentDate = moment(currentMessages[0]['message'].created_at).format('DD.MM.YYYY')
                let currentDateMessages = [];

                currentMessages.forEach(message => {
                    if (moment(message['message'].created_at).format('DD.MM.YYYY') == currentDate) {
                        currentDateMessages.push(message)
                    } else {
                        messagesWithDate[currentDate] = currentDateMessages
                        currentDate = moment(message['message'].created_at).format('DD.MM.YYYY');

                        currentDateMessages = [];
                        currentDateMessages.push(message)
                    }
                })

                messagesWithDate[currentDate] = currentDateMessages
            }

            messages.value = messagesWithDate

            setTimeout(function () {
                let block = document.getElementById("allMessages");

                /*
                console.log(block.scrollTop, block.scrollHeight, window.outerHeight)
                console.log(block.scrollTop + window.outerHeight - block.scrollHeight)
                 */

                if (block.scrollTop < 10){
                    block.scrollTop = block.scrollHeight;
                }
                else if (block.scrollTop + window.outerHeight - block.scrollHeight > 50) {
                    block.scrollTop = block.scrollHeight;
                }
            }, 50);
        })
    }

    const addMessage = async (form, dialogue_id) => {
        errors.value = [];

        try {
            await axios.post('/dialogues/' + dialogue_id, form).then((response) => {
                //messages.value.push(response.data)
            })
        } catch (e){
            errors.value = e.response.data
        }
    }

    const editMessage = async (form, message_id) =>{
        await axios.patch('/dialogues/' + message_id, form).then((response) => {
            //
        })
    }

    const deleteMessage = async (message_id) => {
        await axios.delete('/dialogues/' + message_id).then((response) => {
            //
        })
    }

    const typingMessage = async () => {
        await axios.get('/dialogueTyping').then((response) => {
            //
        })
    }

    return {
        messages,
        errors,
        getMessages,
        addMessage,
        editMessage,
        deleteMessage,
        typingMessage
    }
}
