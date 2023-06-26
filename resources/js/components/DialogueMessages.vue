<template>
    <div class="allMessages" id="allMessages">
        <div v-if="errors">
            <div v-for="(messageError, key) in errors.message" :key="key">
                {{messageError}}
            </div>
        </div>
        <div v-for="(messagesWithoutDate, date) in messages">
            <div class="dateBase">
                <div class="date">
                    {{ date }}
                </div>
            </div>
            <div v-for="item in messagesWithoutDate">
                <div class="messageBlock p-1" :id="item['message'].id" :class="{'companion': my_id != item['message'].user_id, 'our': my_id == item['message'].user_id}">
                    <p class="white-space: pre-line">{{item['message'].content}}</p>
                    <p class="messageAdditional">{{item['user'].name}} в {{ getTime(item['message'].created_at) }}</p>

                    <span class="m-1" v-if="my_id == item['message'].user_id">
                        <span v-if="item['message'].read_at != null">
                            <span title="Собеседник прочитал это сообщение!">🧐</span>
                        </span>
                        <span v-else>
                            <span title="Собеседник не прочитал это сообщение">😶</span>
                        </span>
                    </span>

                    <span class="m-1" v-if="item['message'].edit_at != null">
                        <div class="badge bg-danger" title="Это сообщение было отредактировано">ред.</div>
                    </span>

                    <span class="m-1" v-if="my_id == item['message'].user_id">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false"></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button @click="startEditMessage(item['message'].id, item['message'].content)" type="submit" class="btn btn-info">Редактировать</button>
                                </li>
                                <li>
                                    <button @click="startDeleteMessage(item['message'].id)" type="submit" class="btn btn-danger">Удалить</button>
                                </li>
                            </ul>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="typeDivBase" >
        <div class="typeDiv" id="type">

        </div>
    </div>
</template>

<script>
import useDialogue from "@/composibles/dialogue.js";
import {onMounted} from "vue";
import moment from "moment";

export default {
    name: 'DialogueMessages',
    props: ['data'],
    setup(props) {
        const {messages, errors, getMessages, addMessage, deleteMessage} = useDialogue()

        onMounted(getMessages(props['data'][1]))

        const my_id = props['data'][0]
        const companion_id = props['data'][2]

        Echo.private('dialogue')
            .listen('MessageSent', (e) => {
                getMessages(props['data'][1])
            })

        Echo.private('dialogue')
            .listen('MessageRead', (e) => {
                getMessages(props['data'][1])
            })

        Echo.private('dialogue')
            .listen('MessageEdit', (e) => {
                getMessages(props['data'][1])
            })

        Echo.private('dialogue')
            .listen('MessageDelete', (e) => {
                getMessages(props['data'][1])
            })

        Echo.private('dialogue')
            .listen('TypingMessage', (e) => {
                if (companion_id == e.user.id){
                    const typingBlock = document.getElementById('type')
                    typingBlock.innerHTML = 'Педовка печатает...'

                    setTimeout(function () {
                        typingBlock.innerHTML = ''
                    }, 2000);
                }
            })

        function startEditMessage(message_id, message_text) {
            let submitButton = document.getElementById('submit')
            submitButton.innerHTML = 'изменить'

            const textInputBlock = document.getElementById('messageInput')
            textInputBlock.value  = message_text

            const flag = document.getElementById('flag')
            flag.id = message_id
        }

        const startDeleteMessage = async (message_id) => {
            await deleteMessage(message_id)
        }

        function getTime(value) {
            return moment(value).format('H:mm');
        }

        return {
            messages,
            errors,
            my_id,
            startEditMessage,
            startDeleteMessage,
            getTime
        }
    }
}
</script>

<style scoped>

</style>
