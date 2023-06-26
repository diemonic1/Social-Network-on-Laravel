<template>
    <div class="mb-3 form1">
        <input @keyup="startSearch" v-model="searchForm.key" maxlength='22' name="name" type="text" class="form-control searchForm" id="search_name"
               placeholder="Поиск по имени...">
    </div>
    <div v-for="dialogue in dialogues">
        <div class="mb-3">
            <button @click="startOpenDialogue(dialogue.dialogue_id)" type="submit" class="btn btn-primary dialogueButton">
                <div class="dialogueBlock">
                    <div class="dialogueItem">
                        <img class="avatar" v-bind:src="'/storage/' + dialogue['companionAvatar']">
                    </div>
                    <div class="dialogueItem">
                        <div>{{ dialogue['companionName'] }}</div>
                        <div class="greyColor">{{ dialogue['lastMessageUser'] }}<span v-if="dialogue['lastMessageUser'] != ''">: </span><span v-if="dialogue['lastMessage'].content != undefined">{{ dialogue['lastMessage'].content.slice(0, 12) }}<span v-if="dialogue['lastMessage'].content.length > 10">...</span><span v-if="dialogue['lastMessage'].read_at == null && dialogue['lastMessage'].user_id == my_id"> ⚫</span></span></div>
                    </div>
                    <div class="dialogueItem">
                        <span v-if="dialogue['countOfUnread'] != 0">
                            <div class="dialogueNotification">
                                <span class="badge rounded-pill bg-danger">{{ dialogue['countOfUnread'] }}</span>
                            </div>
                        </span>
                    </div>
                </div>
            </button>
        </div>
    </div>
</template>

<script>
import {onMounted, reactive} from "vue";
import useAllDialogues from "@/composibles/allDialogues.js";

export default {
    name: "AllDialogues",
    props: {
        my_id: {
            required: true,
            type: String
        }
    },
    setup(props) {
        const searchForm = reactive({
            key: '',
        })

        const my_id = props.my_id

        const {dialogues, getAllDialogues, openDialogue} = useAllDialogues()

        onMounted(getAllDialogues())

        Echo.private('dialogue')
            .listen('MessageSent', (e) => {
                getAllDialogues(searchForm.key)
            })

        function startOpenDialogue(dialogue_id) {
            openDialogue(dialogue_id)
        }

        const startSearch = async () => {
            getAllDialogues(searchForm.key)
        }

        return {
            searchForm,
            my_id,
            dialogues,
            startOpenDialogue,
            startSearch
        }
    }
}
</script>

<style scoped>

</style>
