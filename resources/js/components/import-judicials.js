import { Toast } from '../utilities';

export default () => ({
  error: false,
  uploading: false,
  uploadFile: [],
  progress: 0,
  errors: {},
  file: null,
  init() {
    this.$watch('file', () => {
      this.sendFile();
    });
  },
  async sendFile() {
    let file = this.$refs.file.files[0];
    const formData = new FormData();
    formData.append("archivo", file);

    try {
      this.uploading = true;
      const res = await axios.post("/admin/imports/judicials", formData, {
        onUploadProgress: e =>
          (this.progress = Math.round((e.loaded * 100) / e.total))
      });
      if (res.data.import == true) {
        Toast.success(this.getFileUploaded(file));
      }
      this.error = false;
      this.uploadFile.push(file);
      this.uploading = false;
      this.progress = 0;

      var message = res.data.msg;
      if (message) {
        this.resetInputFile();
        Toast.info(message);
      }
    } catch (error) {
      this.errors = error.response.data.errors;
      console.log(error.response.data);
      this.progress = 0;
      this.error = true;
      this.uploading = false;
      this.uploadFile = [];
    }

  },
  getFileUploaded(file) {
    return `Archivo: ${file.name} importado con éxito`;
  },
  resetInputFile() {
    this.error = false;
    this.uploading = false;
    this.uploadFile = [];
    this.progress = 0;
    this.errors = {};
  }
}); 
