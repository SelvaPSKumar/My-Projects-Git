import React, { useState } from 'react'
import "./TaskForm.css"
import Tag from './Tag'

const TaskForm = ({setTasks}) => {
    // const [task, setTask] = useState("")
    // const [status, setStatus] = useState("todo")
    // const handleTaskChange = (e) => {
    //     setTask(e.target.value)
    // }
    // const handleStatusChange = (e) => {
    //     setStatus(e.target.value)
    // }
    // console.log(task, status);
    
    const [taskData, setTaskData] = useState({
        task : "",
        status : "todo",
        tags : []
    })
    
    const handleChange = (e) => {
        // console.log(e.target);

        // const name = e.target.name
        // const value = e.target.value
        // console.log(name, value);

        const {name, value} = e.target //Same Method of above name & Value, simplify code

        setTaskData(prev => {
            return {...prev, [name]: value}
        })
    }

    const checkTag = (tag) => {
        return taskData.tags.some(item => item === tag)
    }

    const selectTag = (tag) => {
        // console.log(tag);
        if(taskData.tags.some(item => item === tag)) {
            const filterTags = taskData.tags.filter(item => item !== tag)
            setTaskData(prev => {
                return {...prev, tags: filterTags}
            })
        } else {
            setTaskData(prev => {
                return {...prev, tags: [...prev.tags, tag]}
            })
        }
    }

    // console.log(taskData.tags);
    

    const handleSubmit = (e) => {
        e.preventDefault()
        console.log(taskData)
        setTasks(prev => {
            return [...prev, taskData]
        })
        setTaskData({
            task : "",
            status : "todo",
            tags : []
        })
    }
    // console.log(taskData)
    
  return (
    <header className='app_header'>
        <form onSubmit={handleSubmit}>
            <input 
            type="text" 
            name='task'
            value={taskData.task}
            className='task_input' 
            placeholder='Enter your task' 
            onChange={handleChange} />

            <div className='task_form_bottom_line'>
                <div>
                    <Tag tagName='HTML' selectTag={selectTag} selected={checkTag("HTML")} />
                    <Tag tagName='CSS' selectTag={selectTag} selected={checkTag("CSS")} />
                    <Tag tagName='JAVASCRIPT' selectTag={selectTag} selected={checkTag("JAVASCRIPT")} />
                    <Tag tagName='REACT' selectTag={selectTag} selected={checkTag("REACT")} />
                </div>

                <div>
                    <select 
                        className='task_status' 
                        name='status'
                        value={taskData.status}
                        onChange={handleChange}>
                        <option value="todo">To Do</option>
                        <option value="doing">Doing</option>
                        <option value="done">Done</option>
                    </select>

                    <button className='task_submit'>+ Add Task</button>
                </div>
            </div>
        </form>
    </header>
  )
}

export default TaskForm