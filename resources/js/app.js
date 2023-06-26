import './bootstrap';
import {createApp} from "vue";
import DialogueMessages from "@/components/DialogueMessages.vue";
import DialogueForm from "@/components/DialogueForm.vue";
import AllDialogues from "@/components/AllDialogues.vue";

const app = createApp({
    components:{
        DialogueMessages,
        DialogueForm
    }
})

const app2 = createApp({
    components:{
        AllDialogues
    }
})

app.mount('#app')

app2.mount('#app2')
