<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div v-bind:class="{'chat-body': true, 'clearfix': true, 'self': message.user.id == user.id}">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.id == user.id ? 'Me' : message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages', 'user']
  };
</script>
