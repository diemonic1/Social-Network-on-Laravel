import {ref} from 'vue';
import axios from "axios";

export default function useAllDialogues(){
    const dialogues = ref([])

    const getAllDialogues = async (key) => {
        if (key == undefined || key == '' || key == ' ') {
            await axios.get('/getAllDialogues').then((response) => {
                dialogues.value = response.data
            })
        }
        else {
            await axios.get('/dialogues/Search=' + key).then((response) => {
                dialogues.value = response.data
            })
        }
    }

    function openDialogue(dialogue_id){
        window.location.href = '/dialogues/' + dialogue_id;
    }

    return {
        dialogues,
        getAllDialogues,
        openDialogue
    }
}
