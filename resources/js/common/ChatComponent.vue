<template>
    <div class="container-fluid">
        <div class="row chat_input_row">
            <div class="col d-flex p-0">
                <div class="my-2 p-0" style="width:80%;">
                    <textarea
                        class="w-100 h-100 p-2"
                        value="メッセージ"
                        v-model="message"
                    ></textarea>
                </div>
                <div class="my-2 p-0" style="width:20%">
                    <button class="w-100 h-100" type="button" @click="send()">
                        <i class="fas fa-paper-plane fa-3x text-primary"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row chat_message_row">
            <div class="col">
                <div v-for="m in messages" :key="m.id">
                    <div
                        class="my-2 chat_message ml-auto"
                        v-if="$userId == m.user_id"
                        style="background:#7f8c8d;"
                    >
                        <div class="m_user_name" style="color: #fff">
                            {{m.user_name}}
                        </div>
                        <div class="m_body" style="color: #fff">
                            {{m.body}}
                        </div>
                        <div class="m_created_at" style="color: #fff">
                            {{m.created_at}}
                        </div>
                    </div>
                    <div
                        class="my-2 chat_message"
                        v-else
                        style="background:#ecf0f1;"
                    >
                        <div class="m_user_name">
                            {{m.user_name}}
                        </div>
                        <div class="m_body">
                            {{m.body}}
                        </div>
                        <div class="m_created_at">
                            {{m.created_at}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "chat-component",
    data: function() {
        return {
            message: "",
            messages: [],
            my_id: ""
        };
    },
    methods: {
        send() {
            const url = "/ajax/chat";
            const params = { message: this.message, userID: this.$userId};
            axios.post(url, params).then(response => {
                // 成功したらメッセージをクリア
                this.message = "";
            });
        },
        getMessages() {
            const url = "/ajax/chat";
            axios.get(url).then(response => {
                this.messages = response.data[0];
                this.my_id = response.data[1];
            });
            //console.log(this.messages);
        }
    },
    mounted() {
        this.getMessages();

        Echo.channel("chat").listen("MessageCreated", e => {
            console.log("MessageCreated");
            this.getMessages(); //全メッセージを再読込
        });
    }
};
</script>
