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
    language: 'zh-TW',
    initialValue: '請告訴我們你的精采故事吧!'
  });
