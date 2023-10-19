function twoclick_reveal(uidOfElement)
{
  let wrapper = document.querySelector('[data-twoclick-id="' + uidOfElement +  '"]');
  wrapper.classList.remove('twoclick-preview-show');

  let contentArea = wrapper.querySelector('.twoclick-content');

  let helper = document.createElement('div');
  helper.innerHTML = JSON.parse(contentArea.dataset.content);

  wrapper.after(...document.createRange().createContextualFragment(JSON.parse(contentArea.dataset.content)).childNodes);
  wrapper.remove();
}
