require('./bootstrap');
import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/editor/dist/i18n/zh-tw';

const editor = new Editor({
  el: document.querySelector('#editor'),
  previewStyle: 'vertical',
  height: '500px',
  initialEditType: 'markdown',
  previewStyle: 'tab',
  theme: 'dark',
  language: 'zh-TW'
});

document.querySelector('#createRecordForm').addEventListener('submit', e => {
  e.preventDefault();
  document.querySelector('#content').value = editor.getMarkdown();
  e.target.submit();
});

// editor.eventManager.removeEventHandler('addImageBlobHook');
// editor.eventManager.listen('addImageBlobHook', (blob, callback) =>{
//   var uploadedImageURL = that.imageUpload(blob);
//   callback(uploadedImageURL, 'alt text');
//   return false;
// });