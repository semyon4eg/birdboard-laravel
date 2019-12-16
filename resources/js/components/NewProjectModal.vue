<template>
    <modal name="new-project" classes="p-10 card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's Start Something New</h1>

        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input type="text"
                               id="title"
                               class="border p-2 text-xs block w-full rounded"
                               :class="errors.title ? 'border-red-500' : 'border-muted-light'"
                               v-model="form.title">
                        <span class="text-xs italic text-red-500" v-if="errors.title" v-text="errors.title[0]"> </span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>

                        <textarea id="description" class="border border-muted-light p-2 text-xs block w-full rounded"
                                  rows="7" v-model="form.description"> </textarea>

                        <span class="text-xs italic text-red-500" v-if="errors.description" v-text="errors.description[0]"> </span>
                    </div>
                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Need Some Tasks?</label>
                        <input type="text"
                               class="border border-muted-light mb-2 p-2 text-xs block w-full rounded"
                               placeholder="Task 1"
                               v-for="task in form.tasks"
                               v-model="task.body">
                    </div>

                    <button type="button" class="inline-flex items-center text-xs" @click="addTask">

                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="20px" height="20px" viewBox="0 0 400 400" style="enable-background:new 0 0 400 400;"
                             xml:space="preserve" class="mr-2">
                            <g>
                                <g>
                                    <path d="M199.995,0C89.716,0,0,89.72,0,200c0,110.279,89.716,200,199.995,200C310.277,400,400,310.279,400,200
                                        C400,89.72,310.277,0,199.995,0z M199.995,373.77C104.182,373.77,26.23,295.816,26.23,200c0-95.817,77.951-173.77,173.765-173.77
                                        c95.817,0,173.772,77.953,173.772,173.77C373.769,295.816,295.812,373.77,199.995,373.77z"/>
                                    <path d="M279.478,186.884h-66.363V120.52c0-7.243-5.872-13.115-13.115-13.115s-13.115,5.873-13.115,13.115v66.368h-66.361
                                        c-7.242,0-13.115,5.873-13.115,13.115c0,7.243,5.873,13.115,13.115,13.115h66.358v66.362c0,7.242,5.872,13.114,13.115,13.114
                                        c7.242,0,13.115-5.872,13.115-13.114v-66.365h66.367c7.241,0,13.114-5.873,13.114-13.115
                                        C292.593,192.757,286.72,186.884,279.478,186.884z"/>
                                </g>
                            </g>
                        </svg>

                        <span>Add New Task Field</span>

                    </button>

                </div>
            </div>

            <footer class="flex justify-end">
                <button type="button" class="button mr-4 is-outlined" @click="$modal.hide('new-project')">Cancel</button>
                <button class="button">Create Project</button>
            </footer>

        </form>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                        {body: ''},
                    ]
                },

                errors: {}
            };
        },
        methods: {
            addTask() {
                this.form.tasks.push({value: ''});
            },

            async submit() {

                try {
                    location = (await axios.post('/projects', this.form)).data.message;
                } catch (error) {
                    this.errors = error.response.data.errors;
                }

            }
        }
    }
</script>
