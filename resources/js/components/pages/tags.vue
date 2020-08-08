<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <p class="_title0">
            Tags
            <Button @click="addModal=true">
              <Icon type="md-add" />Add tag
            </Button>
          </p>

          <div class="_overflow _table_div">
            <table class="_table">
              <!-- TABLE TITLE -->
              <tr>
                <th>ID</th>
                <th>Tag Name</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
              <!-- TABLE TITLE -->

              <!-- ITEMS -->
              <tr v-for="(tag, i) in tags" :key="tag.id">
                <td>{{i+1}}</td>
                <td class="_table_name">{{tag.tagName}}</td>
                <td>{{tag.created_at}}</td>
                <td>
                  <Button size="small" type="info">Edit</Button>
                  <Button size="small" type="error">Delete</Button>
                </td>
              </tr>
              <!-- ITEMS -->
            </table>
          </div>
        </div>

        <!-- tag adding modal -->
        <Modal v-model="addModal" title="Add tag" :mask-closable="false" :closable="false">
          <Input v-model="data.tagName" placeholder="Enter tag nane" />

          <div slot="footer">
            <Button @click="cancelAddTag">Close</Button>
            <Button
              type="primary"
              @click="addTag"
              :disabled="isAdding"
              :loading="isAdding"
            >{{isAdding ? 'Adding' : 'Add tag'}}</Button>
          </div>
        </Modal>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        tagName: "",
      },
      addModal: false,
      isAdding: false,
      tags: [],
    };
  },
  methods: {
    async addTag() {
      if (this.data.tagName.trim()) {
        this.isAdding = true;
        const res = await this.callApi("post", "/app/create_tag", this.data);
        if (res.status === 201) {
          this.tags.unshift(res.data);
          this.s("Tag name has been added successfully!");
          this.addModal = false;
          this.data.tagName = "";
        } else {
          this.swr();
        }
        this.isAdding = false;
      }
    },
    cancelAddTag() {
      this.addModal = false;
      this.data.tagName = "";
    },
  },
  async created() {
    const res = await this.callApi("get", "/app/get_tags");
    if (res.status === 200) {
      this.tags = res.data;
    } else {
      this.swr();
    }
  },
};
</script>