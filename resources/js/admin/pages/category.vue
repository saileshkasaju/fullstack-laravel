<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
          <p class="_title0">
            Catagories
            <Button @click="addModal=true">
              <Icon type="md-add" />Add category
            </Button>
          </p>

          <div class="_overflow _table_div">
            <table class="_table">
              <!-- TABLE TITLE -->
              <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Category Icon</th>
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
                  <Button size="small" type="info" @click="showEditModal(tag, i)">Edit</Button>
                  <Button
                    size="small"
                    type="error"
                    @click="confirmDelete(i)"
                    :loading="tag.isDeleting"
                  >Delete</Button>
                </td>
              </tr>
              <!-- ITEMS -->
            </table>
          </div>
        </div>

        <!-- tag adding modal -->
        <Modal v-model="addModal" title="Add tag" :mask-closable="false" :closable="false">
          <Input v-model="data.tagName" placeholder="Enter tag name" />
          <div class="space">
            <Upload type="drag" :headers="{ 'x-csrf-token': token }" action="/app/upload">
              <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>Click or drag files here to upload</p>
              </div>
            </Upload>
          </div>
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
        <!-- tag editing modal -->
        <Modal v-model="editModal" title="Edit tag" :mask-closable="false" :closable="false">
          <Input v-model="editData.tagName" placeholder="Enter tag name" />

          <div slot="footer">
            <Button @click="cancelEditTag">Close</Button>
            <Button
              type="primary"
              @click="editTag"
              :disabled="isEditing"
              :loading="isEditing"
            >{{isEditing ? 'Editing' : 'Edit tag'}}</Button>
          </div>
        </Modal>
        <!-- tag delete alert modal -->
        <Modal v-model="showDeleteModal" width="360">
          <p slot="header" style="color:#f60;text-align:center">
            <Icon type="ios-information-circle"></Icon>
            <span>Delete confirmation</span>
          </p>
          <div style="text-align:center">
            <p>Are you sure you want to delete tag?</p>
          </div>
          <div slot="footer">
            <Button type="error" size="large" long :loading="isDeleting" @click="deleteTag">Delete</Button>
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
      editData: {
        tagName: "",
      },
      editModal: false,
      isEditing: false,
      editingIndex: -1,
      deletingIndex: -1,
      showDeleteModal: false,
      isDeleting: false,
    };
  },
  methods: {
    async addTag() {
      // if (this.data.tagName.trim() === "")
      //   return this.e("Tag name is required!");
      this.isAdding = true;
      const res = await this.callApi("post", "/app/create_tag", this.data);
      if (res.status === 201) {
        this.tags.unshift(res.data);
        this.s("Tag name has been added successfully!");
        this.addModal = false;
        this.data.tagName = "";
      } else {
        if (res.status === 422) {
          if (res.data.errors.tagName) {
            this.e(res.data.errors.tagName[0]);
          }
        } else {
          this.swr();
        }
      }
      this.isAdding = false;
    },
    cancelAddTag() {
      this.addModal = false;
      this.data.tagName = "";
    },
    showEditModal(tag, index) {
      this.editingIndex = index;
      this.editData = { id: tag.id, tagName: tag.tagName };
      this.editModal = true;
    },
    async editTag() {
      if (this.data.tagName.trim() === "")
        return this.e("Tag name is required!");
      this.isEditing = true;
      const res = await this.callApi("post", "/app/edit_tag", this.editData);
      if (res.status === 200) {
        this.tags[this.editingIndex].tagName = this.editData.tagName;
        this.s("Tag name has been edited successfully!");
        this.editModal = false;
      } else {
        if (res.status === 422) {
          if (res.data.errors.tagName) {
            this.e(res.data.errors.tagName[0]);
          }
        } else {
          this.swr();
        }
      }
      this.isEditing = false;
    },
    cancelEditTag() {
      this.editModal = false;
    },
    confirmDelete(index) {
      this.deletingIndex = index;
      this.showDeleteModal = true;
    },
    async deleteTag() {
      this.isDeleting = true;
      const tag = this.tags[this.deletingIndex];
      // if (!confirm("Are you sure you want to delete this tag?")) return null;
      // tag.isDeleting = true; // does not work since the key isDeleting was not there when vue rendered
      this.$set(tag, "isDeleting", true);
      const res = await this.callApi("delete", `/app/delete_tag/${tag.id}`);
      if (res.status === 200) {
        this.tags.splice(this.deletingIndex, 1);
        this.s("Tag name has been deleted successfully!");
      } else {
        this.swr();
        // this.$set(tag, "isDeleting", undefined); // not required now
        // tag.isDeleting = undefined;
      }
      this.isDeleting = false;
      this.showDeleteModal = false;
    },
  },
  async created() {
    this.token = document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content");
    const res = await this.callApi("get", "/app/get_tags");
    if (res.status === 200) {
      this.tags = res.data;
    } else {
      this.swr();
    }
  },
};
</script>