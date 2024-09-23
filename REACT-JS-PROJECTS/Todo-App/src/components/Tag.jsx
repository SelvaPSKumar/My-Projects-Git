import React from 'react'
import "./Tag.css"

const Tag = ({tagName, selectTag, selected}) => {
  // console.log('propsDatas', propData);
  const tagStyle = {
    HTML: {backgroundColor: "#fda821"},
    CSS: {backgroundColor: "#15d4c8"},
    JAVASCRIPT: {backgroundColor: "#ffd12c"},
    REACT: {backgroundColor: "#4cdafc"},
    default: {backgroundColor: "#f9f9f9"}
  }
  return (
    <button 
    type='button'
      className='tag' 
      style={selected ? tagStyle[tagName] : tagStyle.default}
      onClick={() => selectTag(tagName)}>
      {tagName}
    </button>
  )
}

export default Tag